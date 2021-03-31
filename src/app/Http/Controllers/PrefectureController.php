<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrefectureCollection;
use Illuminate\Http\Request;

class PrefectureController extends Controller
{
    public function index(Request $request)
    {
        return new PrefectureCollection(config('prefectures'));
    }
}
