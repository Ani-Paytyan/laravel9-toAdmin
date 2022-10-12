<?php

namespace App\Services\Workplace;

use App\Dto\IwmsApi\Workplace\IwmsApiWorkplaceResponseDto;
use App\Models\Workplace;

class WorkplaceService implements WorkplaceServiceInterface
{

    public function sync(array $result): void
    {
        $processedIds = [];
        foreach ($result as $data) {
            /** @var IwmsApiWorkplaceResponseDto $data */
            $processedIds[] = $data->getId();
            Workplace::updateOrCreate(
                ['id' => $data->getId()],
                $data->toArray()
            );
        }

        Workplace::whereNotIn('id', $processedIds)->delete();
    }
}
