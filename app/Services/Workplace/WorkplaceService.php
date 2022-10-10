<?php

namespace App\Services\Workplace;

use App\Dto\IwmsApi\Workplace\IwmsApiWorkplaceResponseDto;
use App\Models\Workplace;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;

class WorkplaceService implements WorkplaceServiceInterface
{

    public function syncData(IwmsAPIPaginationResponse $iwmsAPIPaginationResponse): void
    {
        $processedIds = [];
        foreach ($iwmsAPIPaginationResponse->getResults() as $data) {
            /** @var IwmsApiWorkplaceResponseDto $data */
            $processedIds[] = $data->getId();
            Workplace::updateOrCreate(
                ['id' => $data->getId()],
                $data->toArray()
            );
        }

        if (count($processedIds)) {
            Workplace::whereNotIn('id', $processedIds)->delete();
        }
    }
}
