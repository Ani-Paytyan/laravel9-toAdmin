<?php

namespace App\Repositories\Antenna;

use App\Models\Antena;
use Illuminate\Support\Collection;

interface AntennaRepositoryInterface
{
    public function getAntennaData(Antena $antenna, int $rssi): Collection;
}
