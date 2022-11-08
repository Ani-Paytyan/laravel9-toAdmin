<?php

namespace App\Dto\IwmsApi\Unique_Item;

use Carbon\Carbon;

class IwmsApiUniqueItemResponseDto
{
    private string $id;
    private string $itemId;
    private string $workplaceId;
    private string $article;
    private bool $isDeleted;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->itemId = $item['item_id'];
        $this->workplaceId = $item['workplace_id'];
        $this->article = $item['article'];
        $this->isDeleted = $this->itemIsDeleted($item['status']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getWorkplaceId(): string
    {
        return $this->workplaceId;
    }

    public function setWorkplaceId(string $workplaceId): self
    {
        $this->workplaceId = $workplaceId;
        return $this;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'item_id' => $this->getItemId(),
            'workplace_id' => $this->getWorkplaceId(),
            'article' => $this->getArticle(),
            'deleted_at' => $this->isDeleted ? Carbon::now() : null
        ];
    }

    public function setIsDeleted(bool $value): self
    {
        $this->isDeleted = $value;
        return $this;
    }

    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function itemIsDeleted(string $status): bool
    {
        return $status === 'Deleted';
    }
}
