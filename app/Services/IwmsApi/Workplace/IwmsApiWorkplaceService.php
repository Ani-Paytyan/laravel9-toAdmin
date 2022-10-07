<?php

namespace App\Services\IwmsApi\Workplace;

use App\Dto\IwmsApi\IwmsApiWorkplaceDto;
use App\Services\IwmsApi\AbstractIwmsApi;
use Illuminate\Support\Facades\Log;

class IwmsApiWorkplaceService extends AbstractIwmsApi implements IwmsApiWorkplaceServiceInterface
{
    const PER_PAGE = 1;

    private string $companyId;
    private IwmsAPIPaginationResponse $paginationResponse;

    /**
     * @param IwmsApiWorkplaceDto $dto
     */
    public function __construct(IwmsApiWorkplaceDto $dto)
    {
        $this->paginationResponse = new IwmsAPIPaginationResponse();
        $this->companyId = $dto->getCompanyId();
        $this->setUserToken(config('iwms.api_user_token'));
    }

    /**
     * @return IwmsAPIPaginationResponse
     */
    public function workplace(): IwmsAPIPaginationResponse
    {
        do {
            $this->paginationResponse->init($this->request($this->companyId));

        } while ($this->paginationResponse->hasMorePages());

       return $this->paginationResponse;
    }

    /**
     * @param string $companyId
     * @return array
     */
    private function request(string $companyId): array
    {
        try {
            return ($this->getRequestBuilder()->get('workplaces', [
                'company_id' => $companyId,
                'expand' => 'company',
                'per-page' => self::PER_PAGE,
                'page' => $this->paginationResponse->nextPage()
            ]))->json();
        } catch (\Exception $exception) {
            Log::emergency($exception->getMessage());
        }
        return [];
    }
}
