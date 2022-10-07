<?php

namespace App\Services\Workplace;

use App\Dto\IwmsApi\IwmsApiWorkplaceResponseDto;
use App\Dto\Workplace\WorkplaceDto;
use App\Dto\IwmsApi\IwmsApiWorkplaceDto;
use App\Models\Workplace;
use App\Services\IwmsApi\Workplace\IwmsAPIPaginationResponse;
use App\Services\IwmsApi\Workplace\IwmsApiWorkplaceService;

class WorkplaceService implements WorkplaceServiceInterface
{
    private array $processedIds = [];

    private IwmsAPIPaginationResponse $iwmsApiWorkplaceService;

    /**
     * @param WorkplaceDto $dto
     * @return void
     */
    public function workplace(WorkplaceDto $dto): void
    {
        $this->iwmsApiWorkplaceService = (new IwmsApiWorkplaceService(
            (new IwmsApiWorkplaceDto())->setCompanyId($dto->getCompanyId())
        ))->workplace();

        $this->syncData();
    }

    private function syncData(): void
    {
        foreach ($this->iwmsApiWorkplaceService->getResults() as $data) {
            /** @var IwmsApiWorkplaceResponseDto $data */
            $this->processedIds[] = $data->getId();
            Workplace::updateOrCreate(
                ['id' => $data->getId()],
                $data->toArray()
            );
        }

        if (count($this->processedIds)) {
            Workplace::whereNotIn('id', $this->processedIds)->delete();
        }
    }
}
