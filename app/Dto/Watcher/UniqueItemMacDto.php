<?php

namespace App\Dto\Watcher;

use Illuminate\Support\Collection;

class UniqueItemMacDto
{
    private Collection $result;

    public function getResult(): Collection
    {
        return $this->result;
    }

    public function setResult(Collection $result): self
    {
        $this->result = $result;
        return $this;
    }

    public static function createFromResponse(Collection $uniqueItemResponse): self
    {
        return (new self())
            ->setResult($uniqueItemResponse);
    }
}
