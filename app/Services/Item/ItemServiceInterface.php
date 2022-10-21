<?php

namespace App\Services\Item;

interface ItemServiceInterface
{
    public function sync(array $result): void;
}
