<?php

namespace App\Services\UniqueItem;

use App\Dto\UniqueItem\UniqueItemRequestDto;

interface UniqueItemServiceInterface
{
    public function sync(array $result): void;

    public function updateUniqueItems(array $uniqueItems): void;

    public function updateUniqueItem(UniqueItemRequestDto $uniqueItemRequestDto): void;

    public function getUniqueItemByItemId(string $itemId): array;
}
