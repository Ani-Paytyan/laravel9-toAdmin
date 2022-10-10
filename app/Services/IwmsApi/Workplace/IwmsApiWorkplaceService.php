<?php

namespace App\Services\IwmsApi\Workplace;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesRequestDto;
use App\Dto\IwmsApi\Workplace\IwmsApiGetWorkplacesResponseDto;
use App\Services\IwmsApi\AbstractIwmsApi;
use Illuminate\Support\Facades\Log;

class IwmsApiWorkplaceService extends AbstractIwmsApi implements IwmsApiWorkplaceServiceInterface
{
    public function __construct()
    {
        $this->setUserToken(config('iwms.api_user_token'));
    }

    /**
     * @param IwmsApiGetWorkplacesRequestDto $dto
     * @return IwmsApiGetWorkplacesResponseDto
     */
    public function getWorkplace(IwmsApiGetWorkplacesRequestDto $dto): IwmsApiGetWorkplacesResponseDto
    {
        $result = [];
        try {
            $result = ($this->getRequestBuilder()->get('workplaces', [
                'company_id' => $dto->getCompanyId(),
                'expand' => 'company',
                'per-page' => IwmsAPIPaginationResponse::PER_PAGE,
                'page' => $dto->getNextPage()
            ]))->json();

        } catch (\Exception $exception) {
            Log::channel('workplace')->emergency($exception->getMessage());
        }

        return (new IwmsApiGetWorkplacesResponseDto())
            ->setResult($result['results'] ?? [])
            ->setMeta($result['_meta'] ?? []);
    }
}
