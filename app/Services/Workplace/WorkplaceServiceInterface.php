<?php

namespace App\Services\Workplace;

use App\Models\Antena;
use App\Models\Workplace;

interface WorkplaceServiceInterface
{
    public function sync(array $result): void;

    public function addAntena(Workplace $workplace, Antena $antena, string $type): void;

    public function deleteAntena(Workplace $workplace, Antena $antena): void;
}
