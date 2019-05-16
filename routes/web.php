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
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('pessoas', 'PessoaController')->except([
        'create', 'store'
    ]);
    Route::resource('cupons', 'CuponController');
    Route::get('cupons/pessoa/{id}', 'CuponController@getCuponsPessoa');
    Route::resource('faleConoscos', 'FaleConoscoController')->except([
        'create', 'store'
    ]);
    Route::resource('ofertas', 'OfertaController');
    Route::resource('lojas', 'LojaController')->except([
        'create', 'store'
    ]);

    Route::post('upload_image', 'UploadImageController@sendFiles');
    Route::delete('imagens/{imagem_id}', 'FotoAPIController@remover');

    Route::get('cupons/{id}/qrcode', 'QRCodeController@getQrcode')->name('qrcode');
});

