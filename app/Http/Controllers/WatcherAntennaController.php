<?php

namespace App\Http\Controllers;

use App\Dto\Response\MessageDto;
use App\Dto\UniqueItem\UniqueItemRequestDto;
use App\Http\Requests\UniqueItemStoreRequest;
use App\Http\Resources\AntennaDataResource;
use App\Models\Item;
use App\Models\UniqueItem;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiServiceInterface;
use Illuminate\Http\Request;

class WatcherAntennaController extends Controller
{
    public function __construct(
        public WatcherAntennaApiServiceInterface $watcherAntennaApiService,
        public UniqueItemServiceInterface $uniqueItemService
    ){}

    public function getAntennaData(string $mac)
    {
        $antennaData = collect(AntennaDataResource::collection($this->watcherAntennaApiService->see($mac)->getResult()));
        $items = Item::all()->pluck( 'name', 'id')->toArray();

        return view('antennaData.index', compact('antennaData', 'items', 'mac'));
    }

    public function getUniqueItemByItemId(Request $request): array
    {
        return ['uniqueItems' => $this->uniqueItemService->getUniqueItemByItemId($request->get('itemId'))];
    }

    public function uniqueItemToPlug(UniqueItemStoreRequest $request, string $uniqueId): array
    {
        $this->uniqueItemService->updateUniqueItem(UniqueItemRequestDto::createRequest([
            'mac' => $request->get('mac'),
            'uniqueId' => $uniqueId
        ]));

        return ['message' => trans('message.antena.success_message')];
    }

    public function uniqueItemDisable(UniqueItem $uniqueItem, string $mac)
    {
        $uniqueItem->update(['mac' => null]);

        return redirect('watcher/antenna/'. $mac)->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }
}
