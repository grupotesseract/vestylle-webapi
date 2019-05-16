<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Models\Cupon::class, function (Faker $faker) {
    $ofertaAleatoriaId = App\Models\Oferta::inRandomOrder()->first()->id;

    $porcentagens = [
        10,
        20,
        50
    ];

    $porcentagemAleatoria = Arr::random($porcentagens);

    return [
        'titulo' => 'Cupom para testes',
        'subtitulo' => $faker->bs,
        'data_validade' => Carbon\Carbon::now()->addDays(rand(1, 5000)),
        'texto_cupom'=> 'Cupom para promoção: código ' . $ofertaAleatoriaId,
        'oferta_id' => $ofertaAleatoriaId,
        'aparece_listagem' => true,
        'porcentagem_off' => $porcentagemAleatoria
    ];
});
