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
            $company = Company::withTrashed()
                ->updateOrCreate(
                    ['id' => $data->getId()],
                    $data->toArray()
                );
            $company->restore();
        }

        Company::whereNotIn('id', $processedIds)->delete();
    }
}
