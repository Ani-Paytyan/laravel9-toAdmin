<?php

namespace App\Services\Antena;

use App\Dto\Antena\AntenaRequestDto;
use App\Models\Antena;
use Illuminate\Pagination\LengthAwarePaginator;

class AntenaService implements AntenaServiceInterface
{
    public function getAntenaList(): LengthAwarePaginator
    {
        return Antena::paginate(AntenaRequestDto::PAGE);
    }

    public function addAntena(AntenaRequestDto $antenaRequestDto): void
    {
        Antena::create($antenaRequestDto->toArray());
    }

    public function updateAntena(AntenaRequestDto $antenaRequestDto, Antena $antena): void
    {
        $antena->update($antenaRequestDto->toArray());
    }

    public function deleteAntena(Antena $antena): void
    {
        $antena->delete();
    }
}
