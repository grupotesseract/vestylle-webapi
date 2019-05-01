<?php


/*
|--------------------------------------------------------------------------
| API Routes - Rotas acessiveis via autenticação
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('pessoas', 'PessoaAPIController')->except(['store', 'index', 'destroy']);

    Route::get('pessoas/{id}', 'PessoaAPIController@show')->middleware('pessoaid');
    Route::post('pessoas/{id}', 'PessoaAPIController@update')->middleware('pessoaid');

    //Get/Toggle Lista de desejos - Aplicando middleware pessoaid pra checar se é a mesma pessoa
    Route::get('pessoas/{id}/ofertas', 'PessoaAPIController@getOfertas')->middleware('pessoaid');
    Route::post('pessoas/{id}/ofertas', 'PessoaAPIController@postOfertas')->middleware('pessoaid');

    //TODO
    // # Rota para listar os cupons ativos da pessoa?
    // # Rota para listar os cupons utilizados da pessoa?
    // # Rota para listar as infos de 1 cupom dessa pessoa? (para mostrar o ID unico CupomxPessoa)

});


/*
|--------------------------------------------------------------------------
| API Routes - Rotas Publicas
|--------------------------------------------------------------------------
|
| Login, Store de pessoas, fale conosco, GET de quase tudo.
|
*/

//Rotas para teste da subscription das push's
Route::get('/subscriptions', 'SubscriptionController@index');
Route::post('/subscription', 'SubscriptionController@store');

Route::post('pessoas', 'PessoaAPIController@store');
Route::post('/login', 'PessoaAPIController@login');
Route::post('fale_conoscos', 'FaleConoscoAPIController@store');
Route::post('login/facebook', 'PessoaAPIController@redirecionaSocial');

Route::get('lojas', 'LojaAPIController@show');
Route::get('cupons', 'CuponAPIController@index');
Route::get('cupons/{id}', 'CuponAPIController@show');
Route::get('ofertas', 'OfertaAPIController@index');
Route::get('ofertas/{id}', 'OfertaAPIController@show');

