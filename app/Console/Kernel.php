<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Basic\Console\GenerateSeeders;

class Kernel extends ConsoleKernel
{
    /**
     * @Target GenerateSeeders command to run seeder and save in database
     */
    protected $commands = [
        GenerateSeeders::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     * check setting value if it has time will run every minute but if 0 will not work
     */
    protected function schedule(Schedule $schedule)
    {

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
