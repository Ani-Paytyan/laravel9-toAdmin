<?php

namespace App\Dto\IwmsApi\Workplace;

class IwmsApiGetWorkplacesRequestDto
{
    private string $companyId;
    private int $page;

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function setCompanyId(string $companyId): self
    {
        $this->companyId = $companyId;
        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }
}
