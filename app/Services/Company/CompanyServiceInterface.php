<?php

namespace App\Services\Company;

interface CompanyServiceInterface
{
    public function sync(array $result): void;
}
