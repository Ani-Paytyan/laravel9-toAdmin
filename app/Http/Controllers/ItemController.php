<?php

namespace App\Http\Controllers;

use App\Dto\Response\MessageDto;
use App\Http\Requests\UniqueItemUpdateRequest;
use App\Models\Item;
use App\Services\Item\ItemServiceInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;

class ItemController extends Controller
{
    const PAGE = 10;

    public function __construct(
        private UniqueItemServiceInterface $uniqueItemService,
        private ItemServiceInterface $itemService,
    ){}

    public function index()
    {
        $items = $this->itemService->getItemSortingByName(self::PAGE);
        return view('item.index', compact('items'));
    }

    public function edit(Item $item)
    {
        $uniqueItems = $item->uniqueItem()->paginate(self::PAGE);
        return view('item.edit', compact('uniqueItems', 'item'));
    }

    public function update(UniqueItemUpdateRequest $request)
    {
        $this->uniqueItemService->updateUniqueItems($request->get('mac') ?? []);

        return redirect('item')->with([
            'message' => new MessageDto(
                trans('message.unique_item.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

}
