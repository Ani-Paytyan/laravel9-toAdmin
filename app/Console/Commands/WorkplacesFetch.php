<?php

namespace App\Console\Commands;

use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesRequestDto;
use App\Models\Company;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Services\IwmsApi\Workplace\IwmsApiWorkplaceServiceInterface;
use App\Services\Workplace\WorkplaceServiceInterface;
use Illuminate\Console\Command;

class WorkplacesFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workplaces:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Successfully workplaces fetched';

    /**
     * @param IwmsApiWorkplaceServiceInterface $iwmsApiWorkplaceService
     * @param WorkplaceServiceInterface $workplaceService
     * @return void
     */
    public function handle(
        IwmsApiWorkplaceServiceInterface $iwmsApiWorkplaceService,
        WorkplaceServiceInterface $workplaceService): void
    {
        $companyIds = Company::whereNull('deleted_at')->pluck('id')->toArray();
        $workplaces = [];
        foreach ($companyIds as $companyId) {
            do {
                /** @var IwmsAPIPaginationResponse $iwmsAPIPaginationResponse */
                $iwmsAPIPaginationResponse = $iwmsApiWorkplaceService->getWorkplace(
                    (new IwmsApiGetWorkplacesRequestDto())
                        ->setCompanyId($companyId)
                        ->setPage(
                            isset($iwmsAPIPaginationResponse) ? $iwmsAPIPaginationResponse->nextPage() : 1
                        )
                );
                $workplaces = array_merge($workplaces, $iwmsAPIPaginationResponse->getResult());
            } while ($iwmsAPIPaginationResponse->hasMorePages());

            $workplaceService->sync($workplaces);
        }
    }
}
