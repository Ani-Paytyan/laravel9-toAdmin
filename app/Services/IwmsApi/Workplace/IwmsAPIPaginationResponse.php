<?php

namespace App\Services\IwmsApi\Workplace;

use App\Dto\IwmsApi\IwmsApiWorkplaceResponseDto;

class IwmsAPIPaginationResponse
{
    private array $results = [];
    private int $pageCount = 0;
    private int $currentPage = 0;

    public function init(array $response): void
    {
        $this->setResults($response);
        $this->setPageCount($response);
        $this->setCurrentPage($response);
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function setPageCount(array $response): self
    {
        if (!empty($response['_meta'])) {
            $this->pageCount = $response['_meta']['pageCount'] ?? 0;
        }
        return $this;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(array $response): self
    {
        if (!empty($response['_meta'])) {
            $this->currentPage = $response['_meta']['currentPage'] ?? 0;
        }
        return $this;
    }

    public function getResults(): array
    {
        return $this->results;
    }

    public function setResults(array $response): self
    {
        if (!empty($response['results'])) {
            foreach ($response['results'] as $result) {
                $this->results[] = new IwmsApiWorkplaceResponseDto($result);
            }
        }
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
}
