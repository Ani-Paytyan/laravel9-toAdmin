<?php

namespace App\Dto\IwmsApi\Item;

use Carbon\Carbon;

class IwmsApiItemResponseDto
{
    private string $id;
    private ?string $name;
    private ?string $description;
    private ?string $serialNumber;
    private bool $isDeleted;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->description = $item['description'];
        $this->serialNumber = $item['serial_number'];
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'serial_number' => $this->getSerialNumber(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
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
