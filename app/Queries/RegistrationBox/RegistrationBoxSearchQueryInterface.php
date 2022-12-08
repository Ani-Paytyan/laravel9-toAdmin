<?php

namespace App\Queries\RegistrationBox;

use App\Dto\RegistrationBox\RegistrationBoxSearchRequestDto;
use Illuminate\Database\Eloquent\Builder;

interface RegistrationBoxSearchQueryInterface
{
    /**
     * @param RegistrationBoxSearchRequestDto $dto
     * @return Builder
     */
    public function getSearchRegistrationBoxQuery(RegistrationBoxSearchRequestDto $dto): Builder;
}
