<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrefectureCollection extends ResourceCollection
{
    public static $wrap = 'prefectures';
    public function toArray($request): array
    {
        return $this->resource->toArray();
    }
}
