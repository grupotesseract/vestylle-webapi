<?php

namespace App\Console\Commands;

use App\Jobs\RemoverImagem;
use Illuminate\Console\Command;

class LimparCuponsVencidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vestylle:limpar_cupons_vencidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para limpar cupons vencidos a ser executado diariamente';

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
        $cupons_vencidos = \App\Models\Cupon::vencidos()->get(['id'])->all();

        foreach ($cupons_vencidos as $cupom) {

            if ($cupom->fotos) {
                $this->limparImagensDoCupom($cupom->fotos);
            }

            \App\Models\CuponPessoa::whereCupomId($cupom->id)->delete();

            $cupom->delete();
        }
    }

    /**
     * Dispara Job de remover imagem para cada foto do cupom a ser excluído
     *
     * @return void
     */
    public function limparImagensDoCupom($fotos)
    {
        foreach ($fotos as $foto) {
            RemoverImagem::dispatch($foto->id);
        }
    }
}
