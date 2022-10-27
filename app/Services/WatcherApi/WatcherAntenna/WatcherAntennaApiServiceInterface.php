<?php

namespace App\Services\WatcherApi\WatcherAntenna;

use App\Dto\Watcher\UniqueItemMacDto;

interface WatcherAntennaApiServiceInterface
{
    public function see(string $mac): UniqueItemMacDto;
}
