<?php

namespace App\Dto\IwmsApi\Item;

class IwmsApiItemResponseDto
{
    private string $id;
    private ?string $name;
    private ?string $description;
    private ?string $serialNumber;

    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->description = $item['description'];
        $this->serialNumber = $item['serial_number'];
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
            'description' => $this->getDescription()
        ];
    }
}
