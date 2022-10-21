<?php

namespace App\Services\IwmsApi\UniqueItem;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Dto\IwmsApi\Unique_Item\IwmsApiGetUniqueItemRequestDto;
use App\Dto\IwmsApi\Unique_Item\IwmsApiUniqueItemResponseDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiUniqueItemService extends AbstractIwmsApi implements IwmsApiUniqueItemServiceInterface
{
    public function __construct()
    {
        $this->setUserToken(config('iwms.api_user_token'));
    }

    /**
     * @param IwmsApiGetUniqueItemRequestDto $dto
     * @return IwmsAPIPaginationResponse
     */
    public function getUniqueItem(IwmsApiGetUniqueItemRequestDto $dto): IwmsAPIPaginationResponse
    {
        $result = ($this->getRequestBuilder()->get('unique-items', [
            'item_id' => $dto->getItemId(),
            'workplace_id' => $dto->getWorkplaceId(),
            'article' => $dto->getArticle(),
            'page' => $dto->getPage(),
            'per-page' => IwmsAPIPaginationResponse::PER_PAGE
        ]))->json();
        $uniqueItems = array_map(fn ($data) => new IwmsApiUniqueItemResponseDto($data), $result['results']);

        return IwmsAPIPaginationResponse::createFromApiResponse($result)->setResult($uniqueItems);
    }
}
