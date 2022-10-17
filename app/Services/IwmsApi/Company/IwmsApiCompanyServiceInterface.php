<?php

namespace App\Services\IwmsApi\Company;

use App\Dto\IwmsApi\Company\IwmsApiGetCompaniesRequestDto;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;

interface IwmsApiCompanyServiceInterface
{
    public function getCompanies(IwmsApiGetCompaniesRequestDto $dto): IwmsAPIPaginationResponse;
}
