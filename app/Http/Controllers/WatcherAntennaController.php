<?php

namespace App\Http\Controllers;

use App\Http\Resources\AntennaDataResource;
use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WatcherAntennaController extends Controller
{
    public function __construct(
        public WatcherAntennaApiServiceInterface $watcherAntennaApiService
    ){}

    public function getAntennaData(string $mac): AnonymousResourceCollection
    {
        return AntennaDataResource::collection($this->watcherAntennaApiService->see($mac)->getResult());
    }
}
