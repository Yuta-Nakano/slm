<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchCollection;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function index(Request $request): BranchCollection
    {
        $condition = "%{$request->get('search_cond')}%";
        $branches  = Branch::searchText($condition)
            ->paginate();

        return new BranchCollection($branches);
    }


    public function store(StoreBranchRequest $request): BranchResource
    {
        $branch = $request->makeBranch();
        $branch->registrant_user_id = $request->user()->id;
        $branch->updated_user_id    = $request->user()->id;

        DB::beginTransaction();
        try {
            $branch->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $branch->refresh();
        return new BranchResource($branch);
    }


    public function show(Branch $branch): BranchResource
    {
        return new BranchResource($branch);
    }


    public function update(
        UpdateBranchRequest $request,
        Branch $branch
    ): BranchResource
    {
        $branch->fill($request->validated());
        $branch->updated_user_id = $request->user()->id;

        DB::beginTransaction();
        try {
            $branch->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $branch->refresh();
        return new BranchResource($branch);
    }


    public function destroy(Branch $branch)
    {
        if ($branch->stocks->keyBy('product_id')->sum('total')) {
            abort(response(['message' => [
                '商品の在庫が存在する為、' . $branch->name . 'は削除できません。'
            ]], 422));
        }

        if ($branch->inventores->count()) {
            abort(response(['message' => [
                '商品と紐付けされている為、' . $branch->name . 'は削除できません。'
            ]], 422));
        }

        DB::beginTransaction();
        try {
            $branch->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }


    public function indexNotInProductStock(
        Request $request,
        Product $product
    ): BranchCollection
    {
        $condition = "%{$request->get('search_cond')}%";
        $branches  = Branch::whereNotInInventory($product)
            ->searchText($condition)
            ->paginate();
        return new BranchCollection($branches);
    }
}
