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

Route::post('/login', 'PessoaAPIController@login');
Route::get('login/facebook', 'PessoaAPIController@redirecionaSocial');
Route::get('login/facebook/callback', 'PessoaAPIController@trataInformacoesSocial');

Route::resource('cupons', 'CuponAPIController');
Route::resource('ofertas', 'OfertaAPIController');
