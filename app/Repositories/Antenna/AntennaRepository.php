<?php

namespace App\Repositories\Antenna;

use App\Dto\Antena\AntennaDataDto;
use App\Dto\RegistrationBox\RegistrationBoxFilterDto;
use App\Dto\Watcher\UniqueItemMacDto;
use App\Models\Antena;
use App\Models\UniqueItem;
use App\Queries\RegistrationBox\RegistrationBoxQueriesInterface;
use App\Services\WatcherApi\AbstractWatcherApi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class AntennaRepository extends AbstractWatcherApi implements AntennaRepositoryInterface
{
    public function __construct(
        public RegistrationBoxQueriesInterface $registrationBoxQueries
    )
    {
        $this->setApiKey(config('watcher.api_key_token'));
    }

    public function getAntennaData(Antena $antenna): UniqueItemMacDto
    {
        $apiResult = $this->getWatcherAntennas($antenna->mac_address);
        $uniqueItemResponse = new Collection();

        foreach($apiResult['result'] ?? [] as $apiItem) {
            if (!$this->antennaRssiRegistrationBoxExist($antenna->id, abs($apiItem['rssi']))) continue;

            $uniqueItems = UniqueItem::with('item')->where('mac', $apiItem['mac'])->get();
            $uniqueItemMac = $uniqueItems->map(fn($uniqueItem) =>
                (new AntennaDataDto())->setMac($apiItem['mac'])->setUniqueItem($uniqueItem),
            );

            if ($uniqueItemMac->isEmpty()) {
                $uniqueItemMac->push((new AntennaDataDto())->setMac($apiItem['mac']));
            }
            $uniqueItemResponse = $uniqueItemResponse->merge($uniqueItemMac);
        }

        return UniqueItemMacDto::createFromResponse($uniqueItemResponse);
    }

    private function getWatcherAntennas(string $mac): array
    {
        if (!Cache::has('antenna_data') || date('i') % 2 == 0) {
            $antenna_data = ($this->getRequestBuilder()->get('v1/antenna/see/'. $mac))->json();
            Cache::put('antenna_data', $antenna_data, 120);
            return $antenna_data;
        }

        return Cache::get('antenna_data');
    }

    private function antennaRssiRegistrationBoxExist(string $antennaId, int $rssi): bool
    {
        return !!$this->registrationBoxQueries->getRegistrationBoxesByAntennas(
            RegistrationBoxFilterDto::createFromRequest($antennaId, $rssi)
        )->count();
    }
}
