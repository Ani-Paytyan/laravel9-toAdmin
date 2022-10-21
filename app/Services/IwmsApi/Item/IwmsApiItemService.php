<?php
namespace App\Services\IwmsApi\Item;

use App\Dto\IwmsApi\Item\IwmsApiGetItemRequestDto;
use App\Dto\IwmsApi\Item\IwmsApiItemResponseDto;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiItemService extends AbstractIwmsApi implements IwmsApiItemServiceInterface
{
    public function __construct()
    {
        $this->setUserToken(config('iwms.api_user_token'));
    }

    public function getItems(IwmsApiGetItemRequestDto $dto): IwmsAPIPaginationResponse
    {
        $result = ($this->getRequestBuilder()->get('items', [
            'name'=> $dto->getName(),
            'page' => $dto->getPage(),
            'serial_number'=> $dto->getSerialNumber(),
            'per-page' => IwmsAPIPaginationResponse::PER_PAGE,
        ]))->json();

        $items = array_map(fn ($data) => new IwmsApiItemResponseDto($data), $result['results']);

        return IwmsAPIPaginationResponse::createFromApiResponse($result)->setResult($items);
    }
}
