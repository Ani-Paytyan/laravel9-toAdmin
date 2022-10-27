<?php

namespace App\Services\WatcherApi\WatcherAntenna;

use App\Dto\Watcher\UniqueItemMacDto;
use App\Models\Antena;
use App\Repositories\Antenna\AntennaRepositoryInterface;
use App\Services\WatcherApi\AbstractWatcherApi;

class WatcherAntennaApiService extends AbstractWatcherApi implements WatcherAntennaApiServiceInterface
{
    public AntennaRepositoryInterface $antennaRepository;

    public function __construct(AntennaRepositoryInterface $antennaRepository)
    {
        $this->antennaRepository = $antennaRepository;
    }

    public function see(string $mac): UniqueItemMacDto
    {
        return $this->antennaRepository->getAntennaData(Antena::where('mac_address', $mac)->first());
    }
}
