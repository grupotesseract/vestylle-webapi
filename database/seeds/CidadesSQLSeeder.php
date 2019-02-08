<?php

use Illuminate\Database\Seeder;

/**
 * Class CidadesSQLSeeder
 */
class CidadesSQLSeeder extends Seeder
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function run()
    {
        \Eloquent::unguard();
        $path = storage_path() . '/bd_dumps/cidades_dump.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cidades seeded!');
    }

}
