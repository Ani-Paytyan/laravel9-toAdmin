<?php

namespace App\Services\Item;

use App\Dto\IwmsApi\Item\IwmsApiItemResponseDto;
use App\Models\Item;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ItemService implements ItemServiceInterface
{
    public function sync(array $result): void
    {
        $processedIds = [];
        foreach ($result as $data) {
            /** @var IwmsApiItemResponseDto $data */
            $processedIds[] = $data->getId();
            Item::withTrashed()->updateOrCreate(
                    ['id' => $data->getId()],
                    $data->toArray(),
                );
        }
        Item::whereNotIn('id', $processedIds)->delete();
    }

    public function getItemSortingByName($page): LengthAwarePaginator
    {
        return Item::withCount('uniqueItem')->orderBy('name', 'asc')->paginate($page);
    }
}
