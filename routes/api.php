<?php


/*
|--------------------------------------------------------------------------
| API Routes - Rotas acessiveis via autenticação
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('pessoas', 'PessoaAPIController')->except(['store', 'index', 'destroy']);

    //Get/Toggle Lista de desejos - Aplicando middleware pessoaid pra checar se é a mesma pessoa
    Route::get('pessoas/{id}/ofertas', 'PessoaAPIController@getOfertas')->middleware('pessoaid');
    Route::post('pessoas/{id}/ofertas', 'PessoaAPIController@postOfertas')->middleware('pessoaid');

    Route::resource('cupons', 'CuponAPIController')->except(['update', 'destroy','store']);
    Route::resource('ofertas', 'OfertaAPIController')->except(['update', 'destroy','store']);

});


/*
|--------------------------------------------------------------------------
| API Routes - Rotas Publicas
|--------------------------------------------------------------------------
|
| Login, Store de pessoas, fale conosco, GET de quase tudo.
|
*/

//??
Route::get('/subscriptions', 'SubscriptionController@index');
Route::post('/subscription', 'SubscriptionController@store');

Route::post('pessoas', 'PessoaAPIController@store');
Route::post('/login', 'PessoaAPIController@login');

Route::get('login/facebook', 'PessoaAPIController@redirecionaSocial');
//Route::get('login/facebook/callback', 'PessoaAPIController@trataInformacoesSocial');

Route::get('cupons', 'CuponAPIController@index');
Route::get('cupons/{id}', 'CuponAPIController@show');

Route::post('fale_conoscos', 'FaleConoscoAPIController@store');
Route::get('lojas', 'LojaAPIController@show');
Route::get('ofertas', 'OfertaAPIController@index');
Route::get('ofertas/{id}', 'OfertaAPIController@show');




