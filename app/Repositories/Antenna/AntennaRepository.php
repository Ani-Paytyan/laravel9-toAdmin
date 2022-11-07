<?php

namespace App\Repositories\Antenna;

use App\Dto\Antena\AntennaDataDto;
use App\Models\Antena;
use App\Models\UniqueItem;
use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiServiceInterface;
use Illuminate\Support\Collection;

class AntennaRepository implements AntennaRepositoryInterface
{
    public function __construct(
        private WatcherAntennaApiServiceInterface $watcherAntennaApiService
    ){}

    /**
     * @param Antena $antenna
     * @param int $rssi
     * @return Collection
     */
    public function getAntennaData(Antena $antenna, int $rssi): Collection
    {
        $apiResult = $this->getAntennaResponse($antenna);
        $uniqueItems = $this->getUniqueItems($this->getFilterdMacs($apiResult, $rssi));
        $uniqueItemResponse = new Collection();
        foreach ($apiResult['result'] ?? [] as $item) {
            $uniqueItemResponse->push(
                (new AntennaDataDto())
                    ->setMac($item['mac'])
                    ->setUniqueItem($uniqueItems[$item['mac']] ?? null)
            );
        }
        return $uniqueItemResponse;
    }

    private function getAntennaResponse($antenna)
    {
        return $this->watcherAntennaApiService->see($antenna->mac_address);

    }

    /**
     * @param array $apiResult
     * @param int $rssi
     * @return array
     */
    private function getFilterdMacs(array $apiResult, int $rssi): array
    {
        $filteredMacs = [];
        foreach ($apiResult['result'] ?? [] as $item) {
            if(abs($item['rssi']) >= $rssi) $filteredMacs[] = $item['mac'];
        }
        return $filteredMacs;
    }

    /**
     * @param $macs
     * @return Collection
     */
    private function getUniqueItems($macs): Collection
    {
        return UniqueItem::with('item')->whereIn('mac', $macs)->get()->keyBy('mac');
    }
}
