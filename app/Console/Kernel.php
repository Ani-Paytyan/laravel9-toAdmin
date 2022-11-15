<?php

namespace App\Console;

use App\Console\Commands\AntennaDataUpdate;
use App\Console\Commands\CompaniesFetch;
use App\Console\Commands\UniqueItemsFetch;
use App\Console\Commands\ItemsFetch;
use App\Console\Commands\WorkplacesFetch;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CompaniesFetch::class)->everyFifteenMinutes();
        $schedule->command(WorkplacesFetch::class)->everyFifteenMinutes();
        $schedule->command(ItemsFetch::class)->everyFifteenMinutes();
        $schedule->command(UniqueItemsFetch::class)->everyFifteenMinutes();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
