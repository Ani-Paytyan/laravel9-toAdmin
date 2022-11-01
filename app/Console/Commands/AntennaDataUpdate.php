<?php

namespace App\Console\Commands;

use App\Http\Controllers\WatcherAntennaController;
use Illuminate\Console\Command;

class AntennaDataUpdate extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'antenna_data:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @param WatcherAntennaController $watcherAntennaController
     * @return void
     */
    public function handle(WatcherAntennaController $watcherAntennaController)
    {
        $watcherAntennaController->getAntennaData('AAAAAAAAAAAA');
    }
}
