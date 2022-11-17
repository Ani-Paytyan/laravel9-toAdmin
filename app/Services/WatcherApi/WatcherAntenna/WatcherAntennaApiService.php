<?php

namespace App\Services\WatcherApi\WatcherAntenna;

use App\Dto\Watcher\WatcherAntennaStatusDto;
use App\Services\WatcherApi\AbstractWatcherApi;

class WatcherAntennaApiService extends AbstractWatcherApi implements WatcherAntennaApiServiceInterface
{
    public function __construct()
    {
        $this->setApiKey(config('watcher.api_key_token'));
    }

    public function see(string $mac): array
    {
        return ($this->getRequestBuilder()->get('v1/antenna/see/'. $mac))->json();
    }

    public function antennaStatus(WatcherAntennaStatusDto $dto): array
    {
        return $this->getRequestBuilder()->post('v1/antenna/statuses', [
            'list' => $dto->getList()
        ])->json();
    }
}
