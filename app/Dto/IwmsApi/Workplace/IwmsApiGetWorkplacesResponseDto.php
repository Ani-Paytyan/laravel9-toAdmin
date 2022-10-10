<?php

namespace App\Dto\IwmsApi\Workplace;

class IwmsApiGetWorkplacesResponseDto
{
    private array $result;
    private array $meta;

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getMeta(): array
    {
        return $this->meta ?? [];
    }

    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }
}
