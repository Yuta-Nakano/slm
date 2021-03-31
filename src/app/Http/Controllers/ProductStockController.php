<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductStockRequest;
use App\Http\Requests\UpdateProductStockRequest;
use App\Http\Resources\ProductStockCollection;
use App\Http\Resources\ProductStockResource;
use App\Models\Branch;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductStockController extends Controller
{
    public function stockHistoryIndex(
        Branch $branch,
        Product $product
    ): ProductStockCollection
    {
        $stocks = ProductStock::historyIndex($branch, $product)
            ->paginate();
        return new ProductStockCollection($stocks, 200);
    }


    public function store(StoreProductStockRequest $request): ProductStockResource
    {
        $stock = $request->makeProductStock();
        $stock->total += $stock->in;
        $stock->total -= $stock->out;
        $stock->updated_user_id = $request->user()->id;

        DB::beginTransaction();
        try {
            $stock->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $stock->refresh();
        return new ProductStockResource($stock);
    }
}
