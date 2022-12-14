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
        $filteredItems = $this->getFilteredItems($this->getAntennaResponse($antenna->mac_address), $rssi);
        $uniqueItems = $this->getUniqueItems(array_map(fn ($item) => $item['mac'], $filteredItems));
        $uniqueItemResponse = new Collection();
        foreach ($filteredItems ?? [] as $item) {
            $uniqueItemResponse->push(
                (new AntennaDataDto())
                    ->setMac($item['mac'])
                    ->setRssi($item['rssi'])
                    ->setUniqueItem($uniqueItems[$item['mac']] ?? null)
            );
        }
        return $uniqueItemResponse;
    }

    private function getAntennaResponse(string $mac)
    {
        return $this->watcherAntennaApiService->see($mac);
    }

    /**
     * @param array $apiResult
     * @param int $rssi
     * @return array
     */
    private function getFilteredItems(array $apiResult, int $rssi): array
    {
        return array_filter($apiResult['result'] ?? [], function ($item) use ($rssi) {
            return abs($item['rssi']) >= $rssi;
        });
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
