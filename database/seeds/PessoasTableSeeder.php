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
            $pessoaCriada = $repositorio->createFromVestylle($pessoa->cnpj_cpf); 
            
            dump(env('SEED_DADOS_PESSOA'));
            if (env('SEED_DADOS_PESSOA')) {            
                $repositorio->updatePontosPessoa($pessoaCriada); 
                $repositorio->updateVencimentoPontosPessoa($pessoaCriada);
                $repositorio->updateDataUltimaCompraPessoa($pessoaCriada);
            }
        }

    }
}
