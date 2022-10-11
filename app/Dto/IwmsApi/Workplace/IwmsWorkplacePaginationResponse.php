<?php

namespace App\Dto\IwmsApi\Workplace;

use App\Dto\IwmsApi\IwmsAPIPaginationResponse;

class IwmsWorkplacePaginationResponse extends IwmsAPIPaginationResponse
{
    public function setResults(array $response): self
    {
        foreach ($response as $result) {
            $this->results[] = new IwmsApiWorkplaceResponseDto($result);
        }
        return $this;
    }

    public function getResults(): array
    {
        return $this->results;
    }
}
