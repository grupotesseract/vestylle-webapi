<?php

use Illuminate\Database\Seeder;

class LojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Loja::class, 1)->create();
    }
}

