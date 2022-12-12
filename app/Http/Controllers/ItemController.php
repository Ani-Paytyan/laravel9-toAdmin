<?php

namespace App\Http\Controllers;

use App\Dto\Response\MessageDto;
use App\Http\Requests\UniqueItemUpdateRequest;
use App\Models\Item;
use App\Models\UniqueItem;
use App\Services\Item\ItemServiceInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use Illuminate\Http\Request;

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

    public function updateByMac(UniqueItem $uniqueItem, Request $request)
    {
        if ($this->uniqueItemService->updateUniqueItemMac($uniqueItem, $request->get('mac')))
        {
            return response()->json(['error' => 'Success msg'], 200);
        } else {
            return response()->json(['error' => 'Error msg'], 404);
        }
    }

    public function detachedByMac(UniqueItem $uniqueItem)
    {
        $this->uniqueItemService->detachUniqueItemMac($uniqueItem);

        return ['message' => 'success'];
    }
}
