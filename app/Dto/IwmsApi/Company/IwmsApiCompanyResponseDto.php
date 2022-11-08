<?php

namespace App\Dto\IwmsApi\Company;

use Carbon\Carbon;

class IwmsApiCompanyResponseDto
{
    private string $id;
    private int $type;
    private ?string $name;
    private ?string $address;
    private bool $isDeleted;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->address = $item['address'];
        $this->type = $item['type'];
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

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'address' => $this->getAddress(),
            'name' => $this->getName(),
            'type_id' => $this->getType(),
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
