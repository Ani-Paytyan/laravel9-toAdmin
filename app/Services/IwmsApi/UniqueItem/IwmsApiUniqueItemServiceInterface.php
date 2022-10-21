<?php

namespace App\Services\IwmsApi\UniqueItem;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Dto\IwmsApi\Unique_Item\IwmsApiGetUniqueItemRequestDto;

interface IwmsApiUniqueItemServiceInterface
{
    public function getUniqueItem(IwmsApiGetUniqueItemRequestDto $dto): IwmsAPIPaginationResponse;
}
