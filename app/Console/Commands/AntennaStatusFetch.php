<?php

namespace App\Console\Commands;

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
     * @return void
     */
    public function handle(
        WatcherAntennaApiServiceInterface $watcherAntennaApiService): void
    {
        $watcherAntennaApiService->antennaStatus();
    }
}
