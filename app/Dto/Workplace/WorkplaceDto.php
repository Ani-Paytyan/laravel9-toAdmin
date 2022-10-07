<?php

namespace App\Dto\Workplace;

class WorkplaceDto
{
    private string $companyId;

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function setCompanyId(string $companyId): self
    {
        $this->companyId = $companyId;
        return $this;
    }
}
