<?php

namespace App\Services\UniqueItem;

use App\Dto\UniqueItem\UniqueItemRequestDto;
use App\Models\UniqueItem;

interface UniqueItemServiceInterface
{
    public function sync(array $result): void;

    public function updateUniqueItems(array $uniqueItems): void;

    public function updateUniqueItem(UniqueItemRequestDto $uniqueItemRequestDto): void;

    public function disableUniqueItem(UniqueItem $uniqueItem): void;

    public function getUniqueItemByItemId(string $itemId): array;

    public function updateUniqueItemMac(UniqueItem $uniqueItem, string  $mac): void;

    public function detachUniqueItemMac(UniqueItem $uniqueItem): void;
}
