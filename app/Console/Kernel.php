<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\LogoutInactiveUsers;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\UpdateProductStats;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('inspire')->hourly();
         $schedule->command('cache:clear')->daily();
         $schedule->command('app:log-out-inactive-users')->everyMinute();   
         $schedule->command('custom:task')->dailyAt('00:00');
         $schedule->job(new UpdateProductStats)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
