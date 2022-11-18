<?php

namespace App\Console\Commands;

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
     * @param AntenaServiceInterface $antennaService
     * @return void
     */
    public function handle(
        WatcherAntennaApiServiceInterface $watcherAntennaApiService,
        AntenaServiceInterface $antennaService): void
    {
        Antena::chunk(10, function ($antennasMac) use ($watcherAntennaApiService, $antennaService){
            $macAddressStatus = $watcherAntennaApiService->antennaStatus($antennasMac->pluck('mac_address')->toArray());
            $antennaService->updateAntennaStatus($macAddressStatus['result']);
        });;
    }
}
