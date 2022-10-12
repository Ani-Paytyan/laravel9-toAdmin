<?php

namespace App\Dto\IwmsApi;

class IwmsAPIPaginationResponse
{
    const PER_PAGE = 2;

    private array $result = [];
    private int $pageCount = 0;
    private int $currentPage = 0;

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function setPageCount(int $pageCount): self
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): self
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function nextPage(): int
    {
        return $this->currentPage + 1;
    }

    public function hasMorePages(): bool
    {
        return $this->currentPage < $this->pageCount;
    }

    public static function createFromApiResponse(array $response): self
    {
        return (new self())
            ->setCurrentPage($response['_meta']['currentPage'])
            ->setPageCount($response['_meta']['pageCount']);
    }
}
