<?php

namespace App\Queries\ItemQueries;

use App\Dto\Item\ItemFilterDto;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;

class ItemQueries implements ItemQueriesInterface
{
    public function getFilterQuery(ItemFilterDto $itemFilterDto): Builder
    {
        $query = Item::query();

        $query->when($itemFilterDto->getSortBy(), function($q) use ($itemFilterDto) {
            $q->orderBy($itemFilterDto->getSortBy(), $itemFilterDto->getSortType());
        });

        return $query;
    }
}
