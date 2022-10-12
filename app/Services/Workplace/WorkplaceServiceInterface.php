<?php

namespace App\Services\Workplace;

interface WorkplaceServiceInterface
{
    public function sync(array $result): void;
}
