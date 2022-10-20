<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AntenaResource;
use App\Models\Antena;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AntennaController extends Controller
{
    const PAGE = 10;

    public function getAntennas(): AnonymousResourceCollection
    {
        return AntenaResource::collection(Antena::paginate(self::PAGE));
    }
}
