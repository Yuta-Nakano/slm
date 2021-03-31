<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchCollection extends ResourceCollection
{
    public $collects = BranchResource::class;
    public static $wrap = 'branches';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
