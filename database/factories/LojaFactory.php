<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Loja::class, function (Faker $faker) {
    return [
        'nome' => 'Vestylle MegaStore Jaú',
        'cor_primaria' => 'e20f17',
        'cor_secundaria' => 'feca03',
        'cor_terciaria' => '55bcba',
        'endereco' => 'R. Edgard Ferraz, 281 - Centro, Jaú - SP, 17201-440',
        'email' => 'megajau@vestylle.com.br',
        'whatsapp' => nl2br("(14) 2104-3500\n(14) 2104-3500\n(14) 2104-3500"),
        'telefone' => '(14) 2104-3500',
        'horario_funcionamento' => nl2br("Segunda à Sexta 9h às 18h\nSábados 9h às 13h"),
    ];
});

