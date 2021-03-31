<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InventoryCollection extends ResourceCollection
{
    public $collects = InventoryResource::class;
    public static $wrap = 'inventories';
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
