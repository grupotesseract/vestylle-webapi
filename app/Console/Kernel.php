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
        \App\Console\Commands\AtualizaPessoasDataUltimaCompra::class,
        \App\Console\Commands\AtualizaPessoasSemIDVestylle::class,
        \App\Console\Commands\LimparCuponsVencidos::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('vestylle:atualiza-ultimos-compradores')
            ->dailyAt('04:20');

        $schedule->command('vestylle:atualiza-clientes-novos')
            ->dailyAt('04:25');

        $schedule->command('vestylle:limpar_cupons_vencidos')
            ->dailyAt('04:29');
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
