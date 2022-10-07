<?php

namespace App\Services\Workplace;

use App\Dto\Workplace\WorkplaceDto;

interface WorkplaceServiceInterface
{
    public function workplace(WorkplaceDto $dto);
}
