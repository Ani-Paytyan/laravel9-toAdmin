<?php

namespace App\Services\IwmsApi\Item;

use App\Dto\IwmsApi\Item\IwmsApiGetItemRequestDto;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;

interface IwmsApiItemServiceInterface
{
    public function getItems(IwmsApiGetItemRequestDto $dto): IwmsAPIPaginationResponse;
}
