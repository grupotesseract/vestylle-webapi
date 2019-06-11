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

Route::get('/push/{idCampanha}', 'API\SubscriptionAPIController@push')->name('push');





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
    Route::post('cupons/{id}/utilizado-venda', 'CuponController@setUtilizadoVenda')->name('cupons.setUtilizadoVenda');

    Route::get('categorias', 'CategoriaController@index')->name('categorias.index');
    Route::get('categorias/{id}', 'CategoriaController@show')->name('categorias.show');
    Route::get('categorias/{id}/pessoas', 'CategoriaController@showPessoas')->name('categorias.pessoas');
    Route::get('categorias/{id}/ofertas', 'CategoriaController@showofertas')->name('categorias.ofertas');
    Route::get('categorias/{id}/cupons', 'CategoriaController@showcupons')->name('categorias.cupons');

});



Route::resource('tipoInformacaos', 'TipoInformacaoController');


Route::resource('campanhas', 'CampanhaController');

Route::resource('campanhas', 'CampanhaController');

Route::resource('campanhas', 'CampanhaController');