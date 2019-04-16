<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/subscriptions', 'SubscriptionController@index');
Route::post('/subscription', 'SubscriptionController@store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('pessoas', 'PessoaAPIController');
Route::get('pessoas/{id}/ofertas', 'PessoaAPIController@getOfertas');
Route::post('pessoas/{id}/ofertas', 'PessoaAPIController@postOfertas');

Route::post('/login', 'PessoaAPIController@login');
Route::post('login/facebook', 'PessoaAPIController@redirecionaSocial');
//Route::get('login/facebook/callback', 'PessoaAPIController@trataInformacoesSocial');
Route::resource('fale_conoscos', 'FaleConoscoAPIController')->except(['update', 'destroy']);
Route::resource('cupons', 'CuponAPIController');
Route::resource('ofertas', 'OfertaAPIController');


Route::resource('lojas', 'LojaAPIController');
