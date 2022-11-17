<?php

namespace App\Console\Commands;

use App\Dto\Watcher\WatcherAntennaStatusDto;
use App\Models\Antena;
use App\Services\Antena\AntenaServiceInterface;
use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiServiceInterface;
use Illuminate\Console\Command;

class AntennaStatusFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'antenna_status:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Successfully workplaces fetched';

    /**
     * @param WatcherAntennaApiServiceInterface $watcherAntennaApiService
     * @param AntenaServiceInterface $antenaService
     * @return void
     */
    public function handle(
        WatcherAntennaApiServiceInterface $watcherAntennaApiService,
        AntenaServiceInterface $antenaService ): void
    {
        $antennasMac =  Antena::pluck('mac_address')->toArray();
        $macAddressStatus = $watcherAntennaApiService->antennaStatus((new WatcherAntennaStatusDto())
            ->setList($antennasMac));
        $antenaService->updateAntennaStatus($macAddressStatus);
    }
}
