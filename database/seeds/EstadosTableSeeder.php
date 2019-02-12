<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->delete();

        DB::table('estados')->insert(['id' => 1, 'nome' => 'Acre', 'sigla' => 'AC']);
        DB::table('estados')->insert(['id' => 2, 'nome' => 'Alagoas', 'sigla' => 'AL']);
        DB::table('estados')->insert(['id' => 3, 'nome' => 'Amapá', 'sigla' => 'AP']);
        DB::table('estados')->insert(['id' => 4, 'nome' => 'Amazonas', 'sigla' => 'AM']);
        DB::table('estados')->insert(['id' => 5, 'nome' => 'Bahia', 'sigla' => 'BA']);
        DB::table('estados')->insert(['id' => 6, 'nome' => 'Ceará', 'sigla' => 'CE']);
        DB::table('estados')->insert(['id' => 7, 'nome' => 'Distrito Federal', 'sigla' => 'DF']);
        DB::table('estados')->insert(['id' => 8, 'nome' => 'Espírito Santo', 'sigla' => 'ES']);
        DB::table('estados')->insert(['id' => 9, 'nome' => 'Goiás', 'sigla' => 'GO']);
        DB::table('estados')->insert(['id' => 10, 'nome' => 'Maranhão', 'sigla' => 'MA']);
        DB::table('estados')->insert(['id' => 11, 'nome' => 'Mato Grosso', 'sigla' => 'MT']);
        DB::table('estados')->insert(['id' => 12, 'nome' => 'Mato Grosso do Sul', 'sigla' => 'MS']);
        DB::table('estados')->insert(['id' => 13, 'nome' => 'Minas Gerais', 'sigla' => 'MG']);
        DB::table('estados')->insert(['id' => 14, 'nome' => 'Pará', 'sigla' => 'PA']);
        DB::table('estados')->insert(['id' => 15, 'nome' => 'Paraíba', 'sigla' => 'PB']);
        DB::table('estados')->insert(['id' => 16, 'nome' => 'Paraná', 'sigla' => 'PR']);
        DB::table('estados')->insert(['id' => 17, 'nome' => 'Pernambuco', 'sigla' => 'PE']);
        DB::table('estados')->insert(['id' => 18, 'nome' => 'Piauí', 'sigla' => 'PI']);
        DB::table('estados')->insert(['id' => 19, 'nome' => 'Rio de Janeiro', 'sigla' => 'RJ']);
        DB::table('estados')->insert(['id' => 20, 'nome' => 'Rio Grande do Norte', 'sigla' => 'RN']);
        DB::table('estados')->insert(['id' => 21, 'nome' => 'Rio Grande do Sul', 'sigla' => 'RS']);
        DB::table('estados')->insert(['id' => 22, 'nome' => 'Rondônia', 'sigla' => 'RO']);
        DB::table('estados')->insert(['id' => 23, 'nome' => 'Roraima', 'sigla' => 'RR']);
        DB::table('estados')->insert(['id' => 24, 'nome' => 'Santa Catarina', 'sigla' => 'SC']);
        DB::table('estados')->insert(['id' => 25, 'nome' => 'São Paulo', 'sigla' => 'SP']);
        DB::table('estados')->insert(['id' => 26, 'nome' => 'Sergipe', 'sigla' => 'SE']);
        DB::table('estados')->insert(['id' => 27, 'nome' => 'Tocantins', 'sigla' => 'TO']);
    }

}
