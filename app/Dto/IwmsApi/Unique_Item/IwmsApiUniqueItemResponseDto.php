<?php

namespace App\Dto\IwmsApi\Unique_Item;

class IwmsApiUniqueItemResponseDto
{
    private string $id;
    private string $itemId;
    private string $workplaceId;
    private string $article;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->itemId = $item['item_id'];
        $this->workplaceId = $item['workplace_id'];
        $this->article = $item['article'];
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
            'article' => $this->getArticle()
        ];
    }
}
