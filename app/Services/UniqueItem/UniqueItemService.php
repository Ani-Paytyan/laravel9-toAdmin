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
}
