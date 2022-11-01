<?php

namespace App\Dto\UniqueItem;

class UniqueItemRequestDto
{
    private string $mac;
    private string $uniqueItemId;

    public function getMac(): string
    {
        return $this->mac;
    }

    public function getUniqueItemId(): string
    {
        return $this->uniqueItemId;
    }

    public function setUniqueItemId(string $uniqueItemId): self
    {
        $this->uniqueItemId = $uniqueItemId;
        return $this;
    }

    public function setMac(string $mac): self
    {
        $this->mac = $mac;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'mac' => $this->getMac(),
            'uniqueId' => $this->getUniqueItemId()
        ];
    }

    public static function createRequest($request): self
    {
        return (new self())
            ->setMac($request['mac'])
            ->setUniqueItemId($request['uniqueId']);
    }
}
