<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Loja::class, function (Faker $faker) {
    return [
        'endereco' => 'R. Edgard Ferraz, 281 - Centro, Jaú - SP, 17201-440',
        'email' => 'megajau@vestylle.com.br',
        'whatsapp' => "(14) 99766-8707",
        'whatsapp2' => "(14) 9999-9999",
        'telefone' => '(14) 2104-3500',
    ];
});

