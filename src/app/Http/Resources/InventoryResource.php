<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    public static $wrap = 'inventory';
    public function toArray($request): array
    {
        return [
            'id'        => $this->resource->id,
            'branchId'  => $this->resource->branch_id,
            'productId' => $this->resource->product_id,
            'name'      => (new BranchResource($this->branch))->name,
            'stock'     => new ProductStockResource($this->branch->firstNewestStockByProduct($this->product)),
        ];
    }
}
