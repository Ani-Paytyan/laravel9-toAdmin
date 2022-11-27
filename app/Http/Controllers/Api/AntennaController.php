<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AntenaResource;
use App\Models\Antena;
use http\Env\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AntennaController extends Controller
{
    const PAGE = 10;

    public function getAntennas(): AnonymousResourceCollection
    {
        return AntenaResource::collection(Antena::all());
    }

    public function setAntennaStatus($mac, $online) {
        $antenna = Antena::where('mac_address', $mac)->firstOrFail();
        $antenna->is_online = $online == 1;
        $antenna->save();
    }

}
