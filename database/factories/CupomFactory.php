<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Cupon::class, function (Faker $faker) {
    $ofertaAleatoriaId = App\Models\Oferta::inRandomOrder()->first()->id;

    return [
        'data_validade' => Carbon\Carbon::now()->addDays(rand(1, 5000)),
        'texto_cupom'=> 'Cupom para promoção: código ' . $ofertaAleatoriaId,
        'oferta_id' => $ofertaAleatoriaId,
    ];
});
