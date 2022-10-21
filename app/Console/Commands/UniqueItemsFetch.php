<?php

namespace App\Console\Commands;

use App\Dto\IwmsApi\Unique_Item\IwmsApiGetUniqueItemRequestDto;
use App\Services\IwmsApi\UniqueItem\IwmsApiUniqueItemServiceInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use Illuminate\Console\Command;

class UniqueItemsFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unique_items:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle(
        IwmsApiUniqueItemServiceInterface $IwmsApiUniqueItemService,
        UniqueItemServiceInterface $uniqueItemService
    )
    {
        $uniqueItems = [];
        do {
            $iwmsAPIPaginationResponse = $IwmsApiUniqueItemService->getUniqueItem(
                (new IwmsApiGetUniqueItemRequestDto())
                    ->setPage(
                        isset($iwmsAPIPaginationResponse) ? $iwmsAPIPaginationResponse->nextPage() : 1
                    )
            );
            $uniqueItems = array_merge($uniqueItems, $iwmsAPIPaginationResponse->getResult());
        } while ($iwmsAPIPaginationResponse->hasMorePages());

        $uniqueItemService->sync($uniqueItems);
    }
}
