<?php

use Illuminate\Database\Seeder;
use App\Helpers\VestylleDBHelper;

class PessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Eloquent::unguard();
        
        $vestylleDBHelper = new VestylleDBHelper();

        $count = 0;
        $dias = 10;
        
        while ($count <= 10)
        {       
            $pessoas = $vestylleDBHelper->getUltimosRegistros(($vestylleDBHelper::LIMITE_DIAS), $dias);
            $count = count($pessoas);
            $dias++;        
        }

        foreach ($pessoas as $pessoa) {
            $repositorio = new \App\Repositories\PessoaRepository(app());
            $repositorio->createFromVestylle($pessoa->cnpj_cpf);
        }

    }
}
