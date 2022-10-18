<?php

namespace App\Services\AntenaWorkplace;

use App\Dto\AntenaWorkplace\AntenaWorkplaceRequestDto;
use App\Models\Antena;
use App\Models\Workplace;

interface AntenaWorkplaceServiceInterface
{
    public function addAntena(AntenaWorkplaceRequestDto $antenaWorkplaceRequestDto): void;

    public function deleteAntena(Workplace $workplace, Antena $antena): void;
}
