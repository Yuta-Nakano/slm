<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request): ProductCollection
    {
        $condition = "%{$request->get('search_cond')}%";
        $products  = Product::where('name', 'like', $condition)
                    ->paginate();

        return new ProductCollection($products);
    }


    public function store(StoreProductRequest $request): ProductResource
    {
        $userId  = $request->user()->id;
        $product = $request->makeProduct();
        $product->registrant_user_id = $userId;
        $product->updated_user_id    = $userId;

        DB::beginTransaction();
        try {
            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $product->refresh();
        return new ProductResource($product);
    }


    public function show(Product $product): ProductResource
    {
        $product->load(['inventores', 'stocks']);
        return new ProductResource($product);
    }


    public function update(
        UpdateProductRequest $request,
        Product $product
    ): ProductResource
    {
        $product->fill($request->validated());
        $product->updated_user_id = $request->user()->id;

        DB::beginTransaction();
        try {
            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $product->refresh();
        return new ProductResource($product);
    }


    public function destroy(Product $product)
    {
        if ($product->stocks->keyBy('branch_id')->sum('total')) {
            abort(response(['message' => [
                '商品の在庫が存在する為、' . $product->name . 'は削除できません。'
            ]], 422));
        }

        if ($product->inventores->count()) {
            abort(response(['message' => [
                '拠点と紐付けされている為、' . $product->name . 'は削除できません。'
            ]], 422));
        }

        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
