<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = 'product';
    public function toArray($request): array
    {
        return [
            'id'                   => $this->resource->id,
            'name'                 => $this->resource->name,
            'code'                 => $this->resource->code,
            'remarks'              => $this->resource->remarks,
            'registrant_user_name' => $this->resource->registrant_user->name,
            'updated_user_name'    => $this->resource->updated_user->name,
            'num_of_inventores'    => $this->when($this->inventores, $this->inventores->count()),
            'num_of_stock'         => $this->when($this->stocks, $this->stocks->keyBy('branch_id')->sum('total')),
            'can_delete'           => $this->when($this->inventores, $this->stocks->keyBy('branch_id')->sum('total') === 0 && $this->inventores->count() === 0),
        ];
    }
}
