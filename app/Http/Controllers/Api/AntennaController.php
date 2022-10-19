<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antena;
use App\Services\Api\AntennaApiServiceInterface;

class AntennaController extends Controller
{
    const PAGE = 10;

    public AntennaApiServiceInterface $antennaApiService;

    public function __construct(AntennaApiServiceInterface $antennaApiService)
    {
        $this->antennaApiService = $antennaApiService;
    }

    public function getAntennas()
    {
        return Antena::paginate(self::PAGE, ['mac_address','type_id']);
    }
}
