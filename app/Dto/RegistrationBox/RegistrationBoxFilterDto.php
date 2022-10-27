<?php

namespace App\Dto\RegistrationBox;

class RegistrationBoxFilterDto
{
    private string $antennaId;
    private int $rssi;

    public function getAntennaId(): string
    {
        return $this->antennaId;
    }

    public function setAntennaId(string $antennaId): self
    {
        $this->antennaId = $antennaId;
        return $this;
    }

    public function getRssi(): int
    {
        return $this->rssi;
    }

    public function setRssi(int $rssi): self
    {
        $this->rssi = $rssi;
        return $this;
    }

    public static function createFromRequest(string $antennaId, int $rssi): self
    {
        return (new self())
            ->setAntennaId($antennaId)
            ->setRssi($rssi);
    }
}
