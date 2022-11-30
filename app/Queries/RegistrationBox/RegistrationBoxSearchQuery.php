<?php

namespace App\Queries\RegistrationBox;

use App\Dto\RegistrationBox\RegistrationBoxSearchRequestDto;
use App\Models\RegistrationBox;
use Illuminate\Database\Eloquent\Builder;

class RegistrationBoxSearchQuery implements RegistrationBoxSearchQueryInterface
{

    public function getSearchRegistrationBoxQuery(RegistrationBoxSearchRequestDto $dto): Builder
    {
        $query = RegistrationBox::query();

        if ($dto->getName() !== null) {
            $query->where('name','LIKE','%'. $dto->getName().'%');
        }

        if ($dto->getRssiThrottle() !== null) {
            $query->where('rssi_throttle', $dto->getRssiThrottle());
        }

        return $query;
    }
}
