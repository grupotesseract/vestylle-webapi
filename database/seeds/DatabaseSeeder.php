<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadosTableSeeder::class);
        $this->call(CidadesSQLSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(PessoasTableSeeder::class);
        $this->call(OfertaSeeder::class);
        $this->call(CupomSeeder::class);
        $this->call(LojaSeeder::class);
    }
}
