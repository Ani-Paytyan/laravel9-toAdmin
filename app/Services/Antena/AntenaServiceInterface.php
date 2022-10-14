<?php

namespace App\Services\Antena;

use App\Dto\Antena\AntenaRequestDto;
use App\Models\Antena;
use Illuminate\Database\Eloquent\Collection;

interface AntenaServiceInterface
{
    public function getAntenaList(): Collection;

    public function addAntena(AntenaRequestDto $antenaRequestDto);

    public function updateAntena(AntenaRequestDto $antenaRequestDto, Antena $antena);
}
