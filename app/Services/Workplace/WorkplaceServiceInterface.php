<?php

namespace App\Services\Workplace;

interface WorkplaceServiceInterface
{
    public function syncData(array $result): void;
}
