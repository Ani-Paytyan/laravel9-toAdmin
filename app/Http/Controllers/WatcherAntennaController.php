<?php

namespace App\Http\Controllers;

use App\Dto\Response\MessageDto;
use App\Dto\UniqueItem\UniqueItemRequestDto;
use App\Http\Requests\UniqueItemStoreRequest;
use App\Models\UniqueItem;
use App\Repositories\Antenna\AntennaRepository;
use App\Repositories\Antenna\AntennaRepositoryInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiServiceInterface;
use Illuminate\Http\Request;

class WatcherAntennaController extends Controller
{
    public function __construct(
        public WatcherAntennaApiServiceInterface $watcherAntennaApiService,
        public AntennaRepositoryInterface $antennaRepository,
        public UniqueItemServiceInterface $uniqueItemService
    ){
        $this->antennaRepository = new AntennaRepository($watcherAntennaApiService);
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

    public function uniqueItemDisable(UniqueItem $uniqueItem)
    {
        $this->uniqueItemService->disableUniqueItem($uniqueItem);

        return redirect()->back()->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }
}
