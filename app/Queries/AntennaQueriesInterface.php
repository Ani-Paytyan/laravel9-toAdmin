<?php

namespace App\Queries;

use App\Models\Workplace;
use Illuminate\Database\Eloquent\Builder;

interface AntennaQueriesInterface
{
    public function getAntenasWhichNotBelongsToWorkplace(Workplace $workplace): Builder;
}
