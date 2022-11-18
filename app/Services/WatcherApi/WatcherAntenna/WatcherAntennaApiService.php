<?php

namespace App\Services\WatcherApi\WatcherAntenna;

use App\Models\Antena;
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

    public function antennaStatus()
    {
        Antena::chunk(2, function ($antennasMac){
            $result = $this->getRequestBuilder()->post('v1/antenna/statuses', [
                    'list' => $antennasMac->pluck('mac_address')->toArray()
                ])->json();
            $this->updateAntennaStatus($result);
        });;
    }

    public function updateAntennaStatus(array $macAddressStatus)
    {
        foreach ($macAddressStatus['result'] ?? [] as $key => $data) {
            Antena::where('mac_address', $key)->update(['is_online' => $data]);
        }
    }
}
