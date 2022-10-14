<?php

namespace App\Dto\Antena;

class AntenaRequestDto
{
    private string $macAddress;
    private int $type;

    public function getMacAddress(): string
    {
        return $this->macAddress;
    }

    public function setMacAddress(string $macAddress): self
    {
        $this->macAddress = $macAddress;
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

    public function toArray(): array
    {
        return [
            'mac_address' => $this->getMacAddress(),
            'type_id' => $this->getType()
        ];
    }

    public static function createRequest(array $request): self
    {
        return (new self())
            ->setMacAddress($request['mac_address'])
            ->setType($request['type_id']);
    }
}
