<?php

namespace App\Queries\RegistrationBox;

use App\Dto\RegistrationBox\RegistrationBoxFilterDto;

interface RegistrationBoxQueriesInterface
{
    public function getRegistrationBoxesByAntennas(RegistrationBoxFilterDto $registrationBoxFilterDto);
}
