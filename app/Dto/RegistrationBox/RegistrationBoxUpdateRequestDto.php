<?php

namespace App\Dto\RegistrationBox;

class RegistrationBoxUpdateRequestDto
{
    private string $name;
    private int $rssiThrottle;
    private string $antena_id;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getRssiThrottle(): int
    {
        return $this->rssiThrottle;
    }

    public function setRssiThrottle(int $rssiThrottle): self
    {
        $this->rssiThrottle = $rssiThrottle;
        return $this;
    }

    public function getAntenaId(): string
    {
        return $this->antena_id;
    }

    public function setAntenaId(string $antenaId): self
    {
        $this->antena_id = $antenaId;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'rssi_throttle' => $this->getRssiThrottle(),
            'antena_id' => $this->getAntenaId()
        ];
    }

    public static function createRequest(array $request): self
    {
        return (new self())
            ->setName($request['name'])
            ->setRssiThrottle($request['rssi_throttle'])
            ->setAntenaId($request['antena_id']);
    }
}
