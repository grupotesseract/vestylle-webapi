<?php

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
        $pessoaRepository = new \App\Repositories\PessoaRepository(app());
        $pessoaRepository->updateCategorias();
    }
}
