<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Регистрация команд
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }

    /**
     * Планировщик задач
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('stats:daily')->everyMinute();
    }
}
