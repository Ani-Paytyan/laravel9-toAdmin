<?php

namespace App\Console;

use App\Console\Commands\AntennaDataUpdate;
use App\Console\Commands\AntennaStatusFetch;
use App\Console\Commands\CompaniesFetch;
use App\Console\Commands\UniqueItemsFetch;
use App\Console\Commands\ItemsFetch;
use App\Console\Commands\WorkplacesFetch;
use Illuminate\Console\Scheduling\Event;
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
        $syncCommands = [
            $schedule->command(CompaniesFetch::class),
            $schedule->command(WorkplacesFetch::class),
            $schedule->command(ItemsFetch::class),
            $schedule->command(UniqueItemsFetch::class),
            //$schedule->command(AntennaStatusFetch::class),
        ];

        foreach ($syncCommands as $command) {
            /** @var Event $command */
            if (config('app.sync_testing')) {
                $command->everyMinute();
            } else {
                $command->everyFifteenMinutes();
            }
        }

        /*$schedule->command(CompaniesFetch::class)->everyFifteenMinutes();
        $schedule->command(WorkplacesFetch::class)->everyFifteenMinutes();
        $schedule->command(ItemsFetch::class)->everyFifteenMinutes();
        $schedule->command(UniqueItemsFetch::class)->everyFifteenMinutes();*/
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
