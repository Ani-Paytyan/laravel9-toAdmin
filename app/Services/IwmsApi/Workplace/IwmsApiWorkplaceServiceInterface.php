<?php

namespace App\Services\IwmsApi\Workplace;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesRequestDto;

interface IwmsApiWorkplaceServiceInterface
{
    public function getWorkplace(IwmsApiGetWorkplacesRequestDto $dto): IwmsAPIPaginationResponse;
}
