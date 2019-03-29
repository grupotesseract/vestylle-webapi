<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| Rotas da interface administrativa, acessiveis por pessoas 'admin'
|
*/
Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/home', 'HomeController@index');
Route::resource('pessoas', 'PessoaController');
});

Route::resource('cupons', 'CuponController');
Route::get('cupons/pessoa/{id}', 'CuponController@getCuponsPessoa');

Route::resource('pessoas', 'PessoaController');
Route::resource('faleConoscos', 'FaleConoscoController');
Route::resource('ofertas', 'OfertaController');
