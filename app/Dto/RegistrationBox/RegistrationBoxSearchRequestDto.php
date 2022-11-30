<?php

namespace App\Dto\RegistrationBox;

use Illuminate\Http\Request;

class RegistrationBoxSearchRequestDto
{
    private ?string $name;
    private ?int $rssiThrottle;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getRssiThrottle(): ?int
    {
        return $this->rssiThrottle;
    }

    public function setRssiThrottle(?int $rssiThrottle): self
    {
        $this->rssiThrottle = $rssiThrottle;
        return $this;
    }

    /**
     * @param Request $request
     * @return static
     */
    public static function createFromRequest(Request $request): self
    {
        return (new self())
            ->setName($request->get('name'))
            ->setRssiThrottle($request->get('rssi_throttle'));
    }
}
