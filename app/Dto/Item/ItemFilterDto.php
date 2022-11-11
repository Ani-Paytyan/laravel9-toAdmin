<?php

namespace App\Dto\Item;

class ItemFilterDto
{
    private ?string $sortBy;
    private string $sortType;

    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    public function setSortBy(?string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    public function getSortType(): string
    {
        return $this->sortType;
    }

    public function setSortType(string $sortType): self
    {
        $this->sortType = $sortType;
        return $this;
    }

    public static function createFromRequest($request): self
    {
        return (new self())
            ->setSortBy($request->get('sortBy'))
            ->setSortType($request->get('sortType', 'asc'));
    }
}
