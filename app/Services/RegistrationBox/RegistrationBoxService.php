<?php

namespace App\Services\RegistrationBox;

use App\Dto\RegistrationBox\RegistrationBoxCreateRequestDto;
use App\Dto\RegistrationBox\RegistrationBoxUpdateRequestDto;
use App\Models\RegistrationBox;

class RegistrationBoxService implements RegistrationBoxServiceInterface
{
    public function addRegistrationBox(RegistrationBoxCreateRequestDto $registrationBoxRequestDto): void
    {
        RegistrationBox::create($registrationBoxRequestDto->toArray());
    }

    public function updateRegistrationBox(
        RegistrationBoxUpdateRequestDto $registrationBoxUpdateRequestDto,
        RegistrationBox $registrationBox
    ): void
    {
        $registrationBox->update($registrationBoxUpdateRequestDto->toArray());
    }

    public function deleteRegistrationBox(RegistrationBox $registrationBox): void
    {
        $registrationBox->delete();
    }

    public function restoreRegistrationBox(string $registrationBoxId): void
    {
        RegistrationBox::withTrashed()->find($registrationBoxId)->restore();
    }
}
