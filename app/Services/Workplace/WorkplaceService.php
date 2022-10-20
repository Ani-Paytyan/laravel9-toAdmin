<?php

namespace App\Services\Workplace;

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

    public function addAntena(Workplace $workplace, Antena $antena, string $type): void
    {
        $workplace->antenas()->syncWithoutDetaching([
            $antena->id => [ 'type' => $type ]
        ]);
    }

    public function deleteAntena(Workplace $workplace, Antena $antena): void
    {
        $workplace->antenas()->detach($antena);
    }
}
