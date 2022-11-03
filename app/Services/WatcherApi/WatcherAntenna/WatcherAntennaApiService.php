<?php

namespace App\Services\WatcherApi\WatcherAntenna;

use App\Services\WatcherApi\AbstractWatcherApi;
use Illuminate\Support\Facades\Cache;

class WatcherAntennaApiService extends AbstractWatcherApi implements WatcherAntennaApiServiceInterface
{
    public function __construct()
    {
        $this->setApiKey(config('watcher.api_key_token'));
    }

    public function see(string $mac): array
    {
        if (!Cache::has('antenna_data') || date('i') % 2 == 0) {
            $antenna_data = ($this->getRequestBuilder()->get('v1/antenna/see/'. $mac))->json();
            Cache::put('antenna_data', $antenna_data, 120);

            return $antenna_data;
        }
        return Cache::get('antenna_data');
    }
}
