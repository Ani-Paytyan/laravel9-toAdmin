<?php

namespace App\Services\UniqueItem;

use App\Dto\IwmsApi\Unique_Item\IwmsApiUniqueItemResponseDto;
use App\Models\UniqueItem;

class UniqueItemService implements UniqueItemServiceInterface
{
    public function sync(array $result): void
    {
        $processedIds = [];
        foreach ($result as $data) {
            /** @var IwmsApiUniqueItemResponseDto $data */
            $processedIds[] = $data->getId();
            $uniqueItem = UniqueItem::withTrashed()
                ->updateOrCreate(
                    ['id' => $data->getId()],
                    $data->toArray(),
                );
            $uniqueItem->restore();
        }
        UniqueItem::whereNotIn('id', $processedIds)->delete();
    }
}
