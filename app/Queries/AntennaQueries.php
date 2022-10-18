<?php

namespace App\Queries;

use App\Models\Antena;
use App\Models\Workplace;
use Illuminate\Database\Eloquent\Builder;

class AntennaQueries implements AntennaQueriesInterface
{
    public function getAntenasWhichNotBelongsToWorkplace(Workplace $workplace): Builder
    {
        return Antena::whereDoesntHave('workplaces', function ($query) use ($workplace) {
            $query->where('workplaces.id', $workplace->id);
        });
    }

}
