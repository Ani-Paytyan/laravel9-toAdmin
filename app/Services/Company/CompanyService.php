<?php
namespace App\Services\Company;

use App\Models\Company;
use App\Dto\IwmsApi\Company\IwmsApiCompanyResponseDto;

class CompanyService implements CompanyServiceInterface
{
    public function sync(array $result): void
    {
        $processedIds = [];
        foreach ($result as $data) {
            /** @var IwmsApiCompanyResponseDto $data */
            $processedIds[] = $data->getId();
            Company::updateOrCreate(
                ['id' => $data->getId()],
                $data->toArray()
            );
        }

        Company::whereNotIn('id', $processedIds)->delete();
    }

}
