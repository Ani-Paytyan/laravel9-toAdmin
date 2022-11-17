<?php

namespace App\Services\Antena;

use App\Dto\Antena\AntenaRequestDto;
use App\Models\Antena;

interface AntenaServiceInterface
{
    public function addAntena(AntenaRequestDto $antenaRequestDto): void;

    public function updateAntena(AntenaRequestDto $antenaRequestDto, Antena $antena): void;

    public function deleteAntena(Antena $antena): void;

    public function updateAntennaStatus(array $macAddressStatus);
}
