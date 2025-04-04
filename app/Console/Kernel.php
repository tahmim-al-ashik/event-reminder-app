<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendEventReminders;

class Kernel extends ConsoleKernel
{
    /**
     * Register the Artisan commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('events:send-reminders')->everyMinute();
    }

    /**
     * Get the Artisan commands provided by the application.
     *
     * @return array
     */
    protected function commandsList(): array
    {
        return [
            SendEventReminders::class,
        ];
    }
}
