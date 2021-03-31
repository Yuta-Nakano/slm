<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStockResource extends JsonResource
{
    public static $wrap = 'stock';
    public function toArray($request): array
    {
        return [
            'in'                => $this->resource->in,
            'out'               => $this->resource->out,
            'total'             => $this->resource->total,
            'branch_id'         => $this->resource->branch_id,
            'product_id'        => $this->resource->product_id,
            'update_at'         => $this->resource->update_at,
            'updated_user_name' => $this->resource->updated_user->name,
        ];
    }
}
