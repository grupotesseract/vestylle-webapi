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

        try {
            $vestylleDBHelper = new VestylleDBHelper();
        } catch (Exception $e) {
            \Log::debug($e);

            $this->command->error("Falha ao conectar com o BD da vestylle. O erro foi gravado no log do Laravel");
            $this->command->info("\nO seeder PessoasTableSeeder precisará ser executado novamente, copie o comando abaixo pra facilitar");
            $this->command->info("\nartisan db:seed --class=PessoasTableSeeder\n");
            return;
        }

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
                $this->command->info("Trazendo dados da pessoa ".$pessoaCriada->nome);

                if (env('SEED_DADOS_PESSOA')) {
                    $repositorio->updatePontosPessoa($pessoaCriada);
                    $repositorio->updateVencimentoPontosPessoa($pessoaCriada);
                    $repositorio->updateDataUltimaCompraPessoa($pessoaCriada);
                    $repositorio->updateNascimentoPessoa($pessoaCriada);
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
