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
        UniqueItem::whereIn('mac', array_values($uniqueItems))->update(['mac' => null]);
        foreach($uniqueItems as $id => $mac) {
            UniqueItem::find($id)->update(['mac' => $mac]);
            $uniqueItem = UniqueItem::where('id', $id)->firstOrFail();
            if (!$mac) {
                $uniqueItem->is_online = false;
                $uniqueItem->is_inside = false;
                $uniqueItem->save();
            }
        }
    }

    public function updateUniqueItem(UniqueItemRequestDto $uniqueItemRequestDto): void
    {
        UniqueItem::find($uniqueItemRequestDto->getUniqueItemId())
            ->update(['mac' => $uniqueItemRequestDto->getMac()]);
    }

    public function disableUniqueItem(UniqueItem $uniqueItem): void
    {
        $uniqueItem->update(['mac' => null]);
        $uniqueItem = UniqueItem::where('id', $uniqueItem->id)->firstOrFail();
        $uniqueItem->is_online = false;
        $uniqueItem->is_inside = false;
        $uniqueItem->save();
    }


    public function getUniqueItemByItemId(string $itemId): array
    {
        return UniqueItem::where('item_id', $itemId)->whereNull('mac')->pluck('article', 'id')->toArray();
    }

    public function updateUniqueItemMac(UniqueItem $uniqueItem, string $mac): void
    {
        $uniqueItem->update(['mac' => $mac]);
    }

    public function detachUniqueItemMac(UniqueItem $uniqueItem): void
    {
        $uniqueItem->update(['mac' => null]);
    }
}
