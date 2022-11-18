<?php

namespace App\Services\WatcherApi\WatcherAntenna;

interface WatcherAntennaApiServiceInterface
{
    public function see(string $mac): array;

    public function antennaStatus();
}
