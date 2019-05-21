<?php

use Illuminate\Database\Seeder;

class TipoInformacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposInformacao = [
            'ESTILO',
            'HOBBY','NUNCALC',
            'PRTBAIXO',
            'PRTCIMA'
        ];

        foreach ($tiposInformacao as $tipoInformacao) {
            \App\Models\TipoInformacao::create(
                [
                    'tipo_informacao' => $tipoInformacao
                ]
            );
        }        
    }
}
