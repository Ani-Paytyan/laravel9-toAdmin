<?php

namespace App\Services\IwmsApi\Workplace;

use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesRequestDto;
use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesResponseDto;

interface IwmsApiWorkplaceServiceInterface
{
    public function getWorkplace(IwmsApiGetWorkplacesRequestDto $dto): IwmsApiGetWorkplacesResponseDto;
}
