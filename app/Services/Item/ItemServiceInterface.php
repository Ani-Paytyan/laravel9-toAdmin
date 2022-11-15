<?php

namespace App\Services\Item;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ItemServiceInterface
{
    public function sync(array $result): void;

    public function getItemSortingByName($page): LengthAwarePaginator;
}
