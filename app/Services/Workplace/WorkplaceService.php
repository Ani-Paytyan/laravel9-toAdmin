<?php

namespace App\Services\Workplace;

use App\Dto\AntenaWorkplace\AntenaWorkplaceRequestDto;
use App\Dto\IwmsApi\Workplace\IwmsApiWorkplaceResponseDto;
use App\Models\Antena;
use App\Models\Workplace;

class WorkplaceService implements WorkplaceServiceInterface
{
    public function sync(array $result): void
    {
        $processedIds = [];
        foreach ($result as $data) {
            /** @var IwmsApiWorkplaceResponseDto $data */
            $processedIds[] = $data->getId();
            $workplace = Workplace::withTrashed()
                ->updateOrCreate(
                    ['id' => $data->getId()],
                    $data->toArray(),
                );
            $workplace->restore();
        }
        Workplace::whereNotIn('id', $processedIds)->delete();
    }

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
