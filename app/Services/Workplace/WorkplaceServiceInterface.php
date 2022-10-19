<?php

namespace App\Services\Workplace;

use App\Dto\AntenaWorkplace\AntenaWorkplaceRequestDto;
use App\Models\Antena;
use App\Models\Workplace;

interface WorkplaceServiceInterface
{
    public function sync(array $result): void;

    public function addAntena(AntenaWorkplaceRequestDto $antenaWorkplaceRequestDto): void;

    public function deleteAntena(Workplace $workplace, Antena $antena): void;
}
