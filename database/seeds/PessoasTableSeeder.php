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
        $repositorio = new \App\Repositories\PessoaRepository(app());

        $count = 0;
        $dias = 10;

        while ($count <= 5)
        {
            $pessoas = $vestylleDBHelper->getUltimosRegistros(($vestylleDBHelper::LIMITE_DIAS), $dias);
            $count = count($pessoas);
            $dias++;
        }

        foreach ($pessoas as $pessoa) {
            $pessoaApp = $repositorio->findWhere(['cpf' => $pessoa->cnpj_cpf]);

            if ($pessoaApp->count() == 0) {
                $pessoaCriada = $repositorio->createFromVestylle($pessoa->cnpj_cpf);
                $this->command->info(".");

                if (env('SEED_DADOS_PESSOA')) {
                    $repositorio->updatePontosPessoa($pessoaCriada);
                    $repositorio->updateVencimentoPontosPessoa($pessoaCriada);
                    $repositorio->updateDataUltimaCompraPessoa($pessoaCriada);                    
                }
            }
            else {
                $this->command->info("Pulando pessoa ". $pessoa->cnpj_cpf);
            }
        }

        $this->command->info("Pessoas criadas, precisou voltar ~$dias dias. ");

    }
}
