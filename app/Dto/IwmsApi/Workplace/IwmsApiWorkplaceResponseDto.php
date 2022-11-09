<?php

namespace App\Dto\IwmsApi\Workplace;

use Carbon\Carbon;

class IwmsApiWorkplaceResponseDto
{
    private string $id;
    private string $companyId;
    private ?string $name;
    private ?string $address;
    private bool $isDeleted;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->address = $item['address'];
        $this->companyId = $item['company']['id'] ?? '';
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

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function setCompanyId(string $companyId): self
    {
        $this->companyId = $companyId;
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
            'company_id' => $this->getCompanyId(),
            'address' => $this->getAddress(),
            'name' => $this->getName(),
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
