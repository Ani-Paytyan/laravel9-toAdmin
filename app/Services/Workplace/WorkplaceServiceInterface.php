<?php

namespace App\Services\Workplace;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;

interface WorkplaceServiceInterface
{
    public function syncData(IwmsAPIPaginationResponse $iwmsAPIPaginationResponse): void;
}
