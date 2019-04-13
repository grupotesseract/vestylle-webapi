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
        $segmentacao = \App\Models\Categoria::create([
            'descricao' => 'HOBBY',
            'conteudo' => 'MUSICA',            
        ]);
        
        \App\Models\Pessoa::inRandomOrder()->get()->first()->
            segmentos()->create(['categoria_id' => $categoria->id]);

        \App\Models\Oferta::inRandomOrder()->get()->first()->
        segmentos()->create(['categoria_id' => $categoria->id]);

        $categoria = \App\Models\Categoria::create([
            'descricao' => 'CALÇADO',
            'valor' => '39',            
        ]);

        \App\Models\Pessoa::inRandomOrder()->get()->first()->
            segmentos()->create(['categoria_id' => $categoria->id]);

        \App\Models\Oferta::inRandomOrder()->get()->first()->
        segmentos()->create(['categoria_id' => $categoria->id]);

        $categoria = \App\Models\Categoria::create([
            'descricao' => 'ESTILO',
            'conteudo' => 'CASUAL',            
        ]);

        \App\Models\Pessoa::inRandomOrder()->get()->first()->
            segmentos()->create(['categoria_id' => $categoria->id]);

        \App\Models\Oferta::inRandomOrder()->get()->first()->
        segmentos()->create(['categoria_id' => $categoria->id]);
    }
}
