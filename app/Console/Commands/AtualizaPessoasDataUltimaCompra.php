<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AtualizaPessoasDataUltimaCompra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vestylle:atualiza-ultimos-compradores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza as informacoes das pessoas que compraram nos ultimos 2 dias';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pessoaRepository = new \App\Repositories\PessoaRepository( app() );
        $pessoaRepository->updatePessoasUltimasCompras();
        $pessoaRepository->updateCategorias();
    }
}
