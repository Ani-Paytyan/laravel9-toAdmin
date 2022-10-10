<?php

namespace App\Dto\IwmsApi;

use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesResponseDto;
use App\Dto\IwmsApi\Workplace\IwmsApiWorkplaceResponseDto;

class IwmsAPIPaginationResponse
{
    const PER_PAGE = 10;

    private array $results = [];
    private int $pageCount = 0;
    private int $currentPage = 0;

    public function init(IwmsApiGetWorkplacesResponseDto $iwmsApiGetWorkplacesResponseDto): void
    {
        $meta = $iwmsApiGetWorkplacesResponseDto->getMeta();
        $this->setResults($iwmsApiGetWorkplacesResponseDto->getResult());
        $this->setPageCount($meta)
            ->setCurrentPage($meta);
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function setPageCount(array $response): self
    {
        $this->pageCount = $response['pageCount'] ?? 0;
        return $this;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(array $response): self
    {
        $this->currentPage = $response['currentPage'] ?? 0;
        return $this;
    }

    public function getResults(): array
    {
        return $this->results;
    }

    public function setResults(array $response): self
    {
        foreach ($response as $result) {
            $this->results[] = new IwmsApiWorkplaceResponseDto($result);
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
