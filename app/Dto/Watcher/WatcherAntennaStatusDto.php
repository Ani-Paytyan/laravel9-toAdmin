<?php

namespace App\Dto\Watcher;

class WatcherAntennaStatusDto
{
    private array $list;

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $list): self
    {
        $this->list = $list;
        return $this;
    }
}
