<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    public static $wrap = 'branch';
    public function toArray($request): array
    {
        return [
            'id'                   => $this->resource->id,
            'name'                 => $this->resource->name,
            'postal_code'          => $this->resource->postal_code,
            'prefecture'           => $this->resource->prefecture,
            'municipality'         => $this->resource->municipality,
            'address'              => $this->resource->address,
            'building'             => $this->resource->building,
            'charge_name'          => $this->resource->charge_name,
            'phone_number'         => $this->resource->phone_number,
            'remarks'              => $this->resource->remarks,
            'registrant_user_name' => $this->resource->registrant_user->name,
            'updated_user_name'    => $this->resource->updated_user->name,
            'num_of_product'       => $this->when($this->inventores, $this->inventores->count()),
            'num_of_stock'         => $this->when($this->stocks, $this->stocks->keyBy('product_id')->sum('total')),
            'can_delete'           => $this->when($this->stocks, $this->stocks->keyBy('product_id')->sum('total') === 0 && $this->inventores->count() === 0),
        ];
    }
}
