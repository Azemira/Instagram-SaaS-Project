<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (config('pilot.SCHEDULE_TYPE') == 'cron') {
            $schedule->command('queue:work --queue=autopilot,message --sleep=3 --tries=3 --stop-when-empty')
                ->everyMinute()
                ->withoutOverlapping();
        }

        $schedule->command('pilot:get-follower followers')
            ->everyFiveMinutes()
            ->withoutOverlapping();

        $schedule->command('pilot:get-follower following')
            ->everyFiveMinutes()
            ->withoutOverlapping();

        $schedule->command('queue:retry all')
            ->hourly()
            ->withoutOverlapping();

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

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return config('app.timezone');
    }
}
