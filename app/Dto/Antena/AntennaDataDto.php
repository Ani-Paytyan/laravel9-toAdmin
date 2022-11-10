<?php

namespace App\Dto\Antena;

use App\Models\UniqueItem;

class AntennaDataDto
{
    private string $mac;
    private int $rssi;
    private ?UniqueItem $uniqueItem;

    public function getMac(): string
    {
        return $this->mac;
    }

    public function setMac(string $mac): self
    {
        $this->mac = $mac;
        return $this;
    }

    public function getRssi(): string
    {
        return $this->rssi;
    }

    public function setRssi(int $rssi): self
    {
        $this->rssi = $rssi;
        return $this;
    }

    public function getUniqueItem(): ?UniqueItem
    {
        return $this->uniqueItem ?? null;
    }

    public function setUniqueItem(?UniqueItem $uniqueItem): self
    {
        $this->uniqueItem = $uniqueItem;
        return $this;
    }
}
