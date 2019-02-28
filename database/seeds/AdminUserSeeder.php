<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = factory(\App\Models\Pessoa::class)->create([
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', '123321')),
            'nome' => 'Admin'
        ]);

        $userAdmin->attachRole(\App\Models\Role::ADMIN_ROLE);
    }
}
