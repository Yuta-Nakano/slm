<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductStockCollection extends ResourceCollection
{
    public $collects = ProductStockResource::class;
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
