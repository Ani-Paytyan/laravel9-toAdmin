<?php
namespace App\Services\IwmsApi\Company;

use App\Dto\IwmsApi\Company\IwmsApiCompanyResponseDto;
use App\Dto\IwmsApi\Company\IwmsApiGetCompaniesRequestDto;
use App\Dto\IwmsApi\IwmsAPIPaginationResponse;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiCompanyService extends AbstractIwmsApi implements IwmsApiCompanyServiceInterface
{
    public function __construct()
    {
        $this->setUserToken(config('iwms.api_user_token'));
    }

    public function getCompanies(IwmsApiGetCompaniesRequestDto  $dto): IwmsAPIPaginationResponse
    {
        $result = ($this->getRequestBuilder()->get('companies', [
            'per-page' => IwmsAPIPaginationResponse::PER_PAGE,
            'page' => $dto->getPage()
        ]))->json();
        $companies = array_map(fn ($data) => new IwmsApiCompanyResponseDto($data), $result['results']);

        return IwmsAPIPaginationResponse::createFromApiResponse($result)->setResult($companies);
    }


}
