<?php

namespace App\Dto\IwmsApi;

abstract class IwmsAPIPaginationResponse
{
    const PER_PAGE = 1;

    protected array $results = [];
    private int $pageCount = 0;
    private int $currentPage = 0;

    private static ?IwmsAPIPaginationResponse $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public abstract function getResults(): array;
    public abstract function setResults(array $response);

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

    public function nextPage(): int
    {
        return $this->currentPage + 1;
    }

    public function hasMorePages(): bool
    {
        return $this->currentPage < $this->pageCount;
    }
}
