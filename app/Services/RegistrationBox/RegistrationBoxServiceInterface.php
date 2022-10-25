<?php

namespace App\Services\RegistrationBox;

use App\Dto\RegistrationBox\RegistrationBoxCreateRequestDto;
use App\Dto\RegistrationBox\RegistrationBoxUpdateRequestDto;
use App\Models\RegistrationBox;

interface RegistrationBoxServiceInterface
{
    public function addRegistrationBox(RegistrationBoxCreateRequestDto $registrationBoxRequestDto): void;

    public function updateRegistrationBox(RegistrationBoxUpdateRequestDto $registrationBoxUpdateRequestDto, RegistrationBox $registrationBox): void;

    public function deleteRegistrationBox(RegistrationBox $registrationBox): void;

    public function restoreRegistrationBox(string $registrationBoxId): void;
}
