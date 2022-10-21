<?php

namespace App\Console\Commands;

use App\Dto\IwmsApi\Item\IwmsApiGetItemRequestDto;
use App\Services\Item\ItemServiceInterface;
use App\Services\IwmsApi\Item\IwmsApiItemServiceInterface;
use Illuminate\Console\Command;

class ItemsFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(
        IwmsApiItemServiceInterface $IwmsApiItemService,
        ItemServiceInterface $itemService
    )
    {
        $items = [];
        do {
            $iwmsAPIPaginationResponse = $IwmsApiItemService->getItems(
                (new IwmsApiGetItemRequestDto())
                    ->setPage(
                isset($iwmsAPIPaginationResponse) ? $iwmsAPIPaginationResponse->nextPage() : 1
                )
            );
            $items = array_merge($items, $iwmsAPIPaginationResponse->getResult());
        } while ($iwmsAPIPaginationResponse->hasMorePages());

        $itemService->sync($items);
    }
}
