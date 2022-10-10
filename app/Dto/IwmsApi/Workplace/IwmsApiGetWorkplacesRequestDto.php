<?php

namespace App\Dto\IwmsApi\Workplace;

class IwmsApiGetWorkplacesRequestDto
{
    private string $companyId;
    private int $nextPage;

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function setCompanyId(string $companyId): self
    {
        $this->companyId = $companyId;
        return $this;
    }

    public function getNextPage(): int
    {
        return $this->nextPage;
    }

    public function setNextPage(int $nextPage): self
    {
        $this->nextPage = $nextPage;
        return $this;
    }
}
