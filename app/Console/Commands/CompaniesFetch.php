<?php
namespace App\Console\Commands;

use App\Dto\IwmsApi\Company\IwmsApiGetCompaniesRequestDto;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Services\Company\CompanyServiceInterface;
use App\Services\IwmsApi\Company\IwmsApiCompanyServiceInterface;
use Illuminate\Console\Command;

class CompaniesFetch extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'companies:fetch';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Successfully companies fetched';

    /**
     * @param IwmsApiCompanyServiceInterface $iwmsApiCompanyService
     * @param CompanyServiceInterface $companyService
     * @return void
     */
    public function handle(
        IwmsApiCompanyServiceInterface $iwmsApiCompanyService,
        CompanyServiceInterface $companyService): void
    {
        $companies = [];
        do {
            /** @var IwmsAPIPaginationResponse $iwmsAPIPaginationResponse */
            $iwmsAPIPaginationResponse = $iwmsApiCompanyService->getCompanies(
                (new IwmsApiGetCompaniesRequestDto())
                    ->setPage(
                        isset($iwmsAPIPaginationResponse) ? $iwmsAPIPaginationResponse->nextPage() : 1
                    )
            );
            $companies = array_merge($companies, $iwmsAPIPaginationResponse->getResult());
        } while ($iwmsAPIPaginationResponse->hasMorePages());

        $companyService->sync($companies);
    }
}
