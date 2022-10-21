<?php

namespace App\Dto\IwmsApi\Unique_Item;

class IwmsApiGetUniqueItemRequestDto
{
    private int $page;
    private ?string $itemId = null;
    private ?string $workplaceId = null;
    private ?string $article = null;
    private ?string $mac = null;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(?string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getWorkplaceId(): ?string
    {
        return $this->workplaceId;
    }

    public function setWorkplaceId(?string $workplaceId): self
    {
        $this->workplaceId = $workplaceId;
        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): self
    {
        $this->article = $article;
        return $this;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    public function setMac(?string $mac): self
    {
        $this->mac = $mac;
        return $this;
    }
}
