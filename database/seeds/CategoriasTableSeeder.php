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
        
        \App\Models\Pessoa::inRandomOrder()->get()->first()->
            segmentos()->create(['segmentacao_id' => $segmentacao->id]);

        \App\Models\Oferta::inRandomOrder()->get()->first()->
        segmentos()->create(['segmentacao_id' => $segmentacao->id]);

        $segmentacao = \App\Models\Segmentacao::create([
            'descricao' => 'CALÇADO',
            'valor' => '39',            
        ]);

        \App\Models\Pessoa::inRandomOrder()->get()->first()->
            segmentos()->create(['segmentacao_id' => $segmentacao->id]);

        \App\Models\Oferta::inRandomOrder()->get()->first()->
        segmentos()->create(['segmentacao_id' => $segmentacao->id]);

        $segmentacao = \App\Models\Segmentacao::create([
            'descricao' => 'ESTILO',
            'conteudo' => 'CASUAL',            
        ]);

        \App\Models\Pessoa::inRandomOrder()->get()->first()->
            segmentos()->create(['segmentacao_id' => $segmentacao->id]);

        \App\Models\Oferta::inRandomOrder()->get()->first()->
        segmentos()->create(['segmentacao_id' => $segmentacao->id]);
    }
}
