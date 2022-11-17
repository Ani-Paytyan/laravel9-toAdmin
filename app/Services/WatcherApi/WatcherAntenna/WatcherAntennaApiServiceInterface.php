<?php

namespace App\Services\WatcherApi\WatcherAntenna;

use App\Dto\Watcher\WatcherAntennaStatusDto;

interface WatcherAntennaApiServiceInterface
{
    public function see(string $mac): array;

    public function antennaStatus(WatcherAntennaStatusDto $dto): array;
}
