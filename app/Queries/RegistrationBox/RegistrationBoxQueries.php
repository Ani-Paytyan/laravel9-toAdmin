<?php

namespace App\Queries\RegistrationBox;

use App\Dto\RegistrationBox\RegistrationBoxFilterDto;
use App\Models\RegistrationBox;
use Illuminate\Database\Eloquent\Builder;

class RegistrationBoxQueries implements RegistrationBoxQueriesInterface
{
    public function getRegistrationBoxesByAntennas(RegistrationBoxFilterDto $registrationBoxFilterDto): Builder
    {
        return RegistrationBox::query()->where('antena_id', $registrationBoxFilterDto->getAntennaId())
            ->where('rssi_throttle', '<=', $registrationBoxFilterDto->getRssi());
    }
}
