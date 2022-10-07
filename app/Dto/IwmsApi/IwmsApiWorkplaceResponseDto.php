<?php

namespace App\Dto\IwmsApi;

class IwmsApiWorkplaceResponseDto
{
    private string $id;
    private string $companyId;
    private ?string $name;
    private ?string $address;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->address = $item['address'];
        $this->companyId = $item['company']['id'] ?? '';
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
            'name' => $this->getName()
        ];
    }
}
