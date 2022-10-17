<?php

namespace App\Dto\IwmsApi\Company;

class IwmsApiGetCompaniesRequestDto
{
    private int $page;

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
