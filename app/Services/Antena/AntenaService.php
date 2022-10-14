<?php

namespace App\Services\Antena;

use App\Dto\Antena\AntenaRequestDto;
use App\Models\Antena;
use Illuminate\Database\Eloquent\Collection;

class AntenaService implements AntenaServiceInterface
{
    public function getAntenaList(): Collection
    {
        return Antena::all();
    }

    public function addAntena(AntenaRequestDto $antenaRequestDto): void
    {
        Antena::create($antenaRequestDto->toArray());
    }

    public function updateAntena(AntenaRequestDto $antenaRequestDto, Antena $antena): void
    {
        $antena->update($antenaRequestDto->toArray());
    }
}
