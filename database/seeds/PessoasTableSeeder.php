<?php

use Illuminate\Database\Seeder;

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
        $path = storage_path() . '/bd_dumps/pessoas_dump.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Pessoas seeded!');
    }
}
