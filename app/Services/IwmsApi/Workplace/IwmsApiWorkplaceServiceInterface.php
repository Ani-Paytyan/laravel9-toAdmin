<?php

namespace App\Services\IwmsApi\Workplace;

interface IwmsApiWorkplaceServiceInterface
{
    public function workplace(): IwmsAPIPaginationResponse;
}
