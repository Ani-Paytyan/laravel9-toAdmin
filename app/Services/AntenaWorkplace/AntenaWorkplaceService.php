<?php

namespace App\Services\AntenaWorkplace;

use App\Dto\AntenaWorkplace\AntenaWorkplaceRequestDto;
use App\Models\Antena;
use App\Models\Workplace;

class AntenaWorkplaceService implements AntenaWorkplaceServiceInterface
{
    public function addAntena(AntenaWorkplaceRequestDto $antenaWorkplaceRequestDto): void
    {
        $workplace = $antenaWorkplaceRequestDto->getWorkplace();

        $workplace->antenas()->syncWithoutDetaching([
                $antenaWorkplaceRequestDto->getAntenaUuid() => [
                    'type' => $antenaWorkplaceRequestDto->getType()
                ]
            ]);
    }

    public function deleteAntena(Workplace $workplace, Antena $antena): void
    {
        $workplace->antenas()->detach($antena);
    }

}
