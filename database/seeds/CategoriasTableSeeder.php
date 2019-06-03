<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $pessoaRepository = new \App\Repositories\PessoaRepository(app());
            $pessoaRepository->updateCategorias();
        } catch (Exception $e) {
            Log::debug($e);

            $this->command->error("Falha ao conectar com o BD da vestylle. O erro foi gravado no log do Laravel");
            $this->command->info("\nO seeder CategoriasTableSeeder precisará ser executado novamente, copie o comando abaixo pra facilitar");
            $this->command->info("\nartisan db:seed --class=CategoriasTableSeeder\n");
        }
    }
}
