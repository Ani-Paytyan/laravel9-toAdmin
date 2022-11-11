<?php

namespace App\Queries\ItemQueries;

use App\Dto\Item\ItemFilterDto;
use Illuminate\Database\Eloquent\Builder;

interface ItemQueriesInterface
{
    public function getFilterQuery(ItemFilterDto $itemFilterDto): Builder;
}
