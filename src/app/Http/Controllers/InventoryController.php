<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Http\Resources\InventoryCollection;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function store(StoreInventoryRequest $request): InventoryResource
    {
        $inventory = $request->makeInventory();

        DB::beginTransaction();
        try {
            $inventory->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $inventory->refresh();
        return new InventoryResource($inventory);
    }


    public function destroy(Inventory $inventory)
    {
        $branch = $inventory->branch;
        $stock  = $branch->firstNewestStockByProduct($inventory->product);
        if ($stock && $stock->total) {
            abort(response(['message' => [
                '商品の在庫が存在する為、' . $branch->name . 'との紐付けが解除できません。'
            ]], 422));
        }

        DB::beginTransaction();
        try {
            $inventory->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }


    public function indexInProduct(Product $product): InventoryCollection
    {
        $inventories = $product
            ->inventores()
            ->orderBy('branch_id')
            ->paginate();
        return new InventoryCollection($inventories);
    }
}
