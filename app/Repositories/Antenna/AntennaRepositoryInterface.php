<?php

namespace App\Repositories\Antenna;

use App\Dto\Watcher\UniqueItemMacDto;
use App\Models\Antena;

interface AntennaRepositoryInterface
{
    public function getAntennaData(Antena $antenna): UniqueItemMacDto;
}
