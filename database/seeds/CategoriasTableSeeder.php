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
        $segmentacao = \App\Models\Segmentacao::create([
            'descricao' => 'HOBBY',
            'conteudo' => 'MUSICA',            
        ]);

        $segmentacao = \App\Models\Segmentacao::create([
            'descricao' => 'CALÇADO',
            'valor' => '39',            
        ]);

        $segmentacao = \App\Models\Segmentacao::create([
            'descricao' => 'ESTILO',
            'conteudo' => 'CASUAL',            
        ]);

    }
}
