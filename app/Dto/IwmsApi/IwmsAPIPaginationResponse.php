<?php

namespace App\Dto\IwmsApi;

use App\Dto\IwmsApi\Workplace\IwmsApiWorkplaceResponseDto;

class IwmsAPIPaginationResponse
{
    const PER_PAGE = 1;

    private array $results = [];
    private int $pageCount = 0;
    private int $currentPage = 0;

    private static ?IwmsAPIPaginationResponse $instance = null;

    private function __construct() {}

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new IwmsAPIPaginationResponse();
        }

        return self::$instance;
    }

    public function init(array $response): self
    {
        $this->setResults($response['results'] ?? []);
        $this->setPageCount($response['_meta'] ?? [])
            ->setCurrentPage($response['_meta'] ?? []);

        return $this;
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
