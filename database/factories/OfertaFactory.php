<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Models\Oferta::class, function (Faker $faker) {
    $nomesDeProdutos = [
        'Blusas',
        'Calças',
        'Sapatos',
        'Acessórios',
        'Vestidos',
        'Camisetas',
        'Baby looks',
        'Roupas de praia',
    ];

    $frasesDePromocao = [
        'com preços imperdíveis',
        "até " . rand(0,90) . "% OFF",
        'da estação em liquidação',
        'em oferta só hoje'
    ];

    $produtoAleatorio = Arr::random($nomesDeProdutos);
    $promocaoAleatoria = Arr::random($frasesDePromocao);

    return [
        'titulo' => $produtoAleatorio,
        'subtitulo' => 'Oferta fícticia simulando peças do tipo ' . $produtoAleatorio,
        'preco' => rand(199, 5999) / 10,
        'descricao_oferta' => 'Oferta de ' . $produtoAleatorio,
        'texto_oferta' => $produtoAleatorio . ' ' . $promocaoAleatoria,
    ];
});


