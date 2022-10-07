<?php

namespace App\Dto\IwmsApi;

class IwmsApiWorkplaceDto
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
