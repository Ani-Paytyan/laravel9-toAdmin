<?php

namespace App\Http\Controllers;

use App\Dto\Response\MessageDto;
use App\Models\Item;
use App\Models\UniqueItem;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    const PAGE = 10;

    public UniqueItemServiceInterface $uniqueItemService;

    public function __construct(UniqueItemServiceInterface $uniqueItemService)
    {
        $this->uniqueItemService = $uniqueItemService;
    }

    public function index()
    {
        $items = Item::withCount('uniqueItem')->paginate(self::PAGE);
        return view('item.index', compact('items'));
    }

    public function edit(Item $item)
    {
        $uniqueItems = $item->uniqueItem()->paginate(self::PAGE);
        return view('item.edit', compact('uniqueItems', 'item'));
    }

    public function update(Request $request)
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
