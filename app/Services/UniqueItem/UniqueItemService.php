<?php

namespace App\Services\UniqueItem;

use App\Dto\IwmsApi\Unique_Item\IwmsApiUniqueItemResponseDto;
use App\Dto\UniqueItem\UniqueItemRequestDto;
use App\Models\UniqueItem;

class UniqueItemService implements UniqueItemServiceInterface
{
    public function sync(array $result): void
    {
        $processedIds = [];
        foreach ($result as $data) {
            /** @var IwmsApiUniqueItemResponseDto $data */
            $processedIds[] = $data->getId();
            UniqueItem::withTrashed()
                ->updateOrCreate(
                    ['id' => $data->getId()],
                    $data->toArray(),
                );
        }
        UniqueItem::whereNotIn('id', $processedIds)->delete();
    }

    public function updateUniqueItems(array $uniqueItems): void
    {
        foreach($uniqueItems as $id => $mac) {
            UniqueItem::find($id)->update(['mac' => $mac]);
        }
    }

    public function updateUniqueItem(UniqueItemRequestDto $uniqueItemRequestDto): void
    {
        UniqueItem::find($uniqueItemRequestDto->getUniqueItemId())
            ->update(['mac' => $uniqueItemRequestDto->getMac()]);
    }

    public function getUniqueItemByItemId(string $itemId): array
    {
        return UniqueItem::where('item_id', $itemId)->pluck('article', 'id')->toArray();
    }
}
