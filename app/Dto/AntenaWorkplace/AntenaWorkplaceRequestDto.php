<?php

namespace App\Dto\AntenaWorkplace;

use App\Models\Workplace;

class AntenaWorkplaceRequestDto
{
    private string $antenaUuid;
    private Workplace $workplace;
    private string $type;

    public function getAntenaUuid(): string
    {
        return $this->antenaUuid;
    }

    public function setAntenaUuid(string $antenaUuid): self
    {
        $this->antenaUuid = $antenaUuid;
        return $this;
    }

    public function getWorkplace(): Workplace
    {
        return $this->workplace;
    }

    public function setWorkplace(Workplace $workplace): self
    {
        $this->workplace = $workplace;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'antena_id' => $this->getAntenaUuid(),
            'workplace_id' => $this->getWorkplace(),
            'type' => $this->getType()
        ];
    }

    public static function createRequest(array $request, $workplace): self
    {
        return (new self())
            ->setAntenaUuid($request['antena_id'])
            ->setWorkplace($workplace)
            ->setType($request['type']);
    }
}
