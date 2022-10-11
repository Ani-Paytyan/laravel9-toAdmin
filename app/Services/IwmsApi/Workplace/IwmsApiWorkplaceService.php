<?php

namespace App\Services\IwmsApi\Workplace;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesRequestDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiWorkplaceService extends AbstractIwmsApi implements IwmsApiWorkplaceServiceInterface
{
    public function __construct()
    {
        $this->setUserToken(config('iwms.api_user_token'));
    }

    /**
     * @param IwmsApiGetWorkplacesRequestDto $dto
     * @return IwmsAPIPaginationResponse
     */
    public function getWorkplace(IwmsApiGetWorkplacesRequestDto $dto): IwmsAPIPaginationResponse
    {
        $result = ($this->getRequestBuilder()->get('workplaces', [
            'company_id' => $dto->getCompanyId(),
            'expand' => 'company',
            'per-page' => IwmsAPIPaginationResponse::PER_PAGE,
            'page' => $dto->getPage()
        ]))->json();

        return IwmsAPIPaginationResponse::getInstance()->init($result ?? []);
    }
}
