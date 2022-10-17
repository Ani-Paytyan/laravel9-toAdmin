<?php

namespace App\Services\Antena;

use App\Dto\Antena\AntenaRequestDto;
use App\Models\Antena;
use Illuminate\Pagination\LengthAwarePaginator;

interface AntenaServiceInterface
{
    public function getAntenaList(): LengthAwarePaginator;

    public function addAntena(AntenaRequestDto $antenaRequestDto): void;

    public function updateAntena(AntenaRequestDto $antenaRequestDto, Antena $antena): void;

    public function deleteAntena(Antena $antena): void;
}
