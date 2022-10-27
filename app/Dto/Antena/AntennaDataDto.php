<?php

namespace App\Dto\Antena;

use App\Models\UniqueItem;

class AntennaDataDto
{
    private string $mac;
    private ?UniqueItem $uniqueItem = null;

    public function getMac(): string
    {
        return $this->mac;
    }

    public function setMac(string $mac): self
    {
        $this->mac = $mac;
        return $this;
    }

    public function getUniqueItem(): ?UniqueItem
    {
        return $this->uniqueItem;
    }

    public function setUniqueItem(UniqueItem $uniqueItem): self
    {
        $this->uniqueItem = $uniqueItem;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'mac' => $this->getMac(),
            'unique_item' => $this->getUniqueItem()
         ];
    }
}
