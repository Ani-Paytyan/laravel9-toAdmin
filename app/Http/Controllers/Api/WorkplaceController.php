<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkplaceResource;
use App\Models\Workplace;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkplaceController extends Controller
{
    const PAGE = 10;

    public function getWorkplaces(): AnonymousResourceCollection
    {
        return WorkplaceResource::collection(Workplace::all());
    }
}
