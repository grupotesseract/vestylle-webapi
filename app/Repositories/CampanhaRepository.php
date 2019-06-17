<?php

namespace App\Repositories;

use App\Models\Campanha;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CampanhaRepository
 * @package App\Repositories
 * @version June 6, 2019, 10:39 pm UTC
 *
 * @method Campanha findWithoutFail($id, $columns = ['*'])
 * @method Campanha find($id, $columns = ['*'])
 * @method Campanha first($columns = ['*'])
*/
class CampanhaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Campanha::class;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function trataRequestCampanhas(&$request, &$campanha)
    {

        if (!$request->segmentar_data_nascimento) {
            $request->request->add(['data_nascimento_menor' => null]);
            $request->request->add(['data_nascimento_maior' => null]);
        }

        if (!$request->segmentar_data_vencimento_pontos) {
            $request->request->add(['data_vencimento_pontos_menor' => null]);
            $request->request->add(['data_vencimento_pontos_maior' => null]);
        }

        if (!$request->segmentar_data_ultima_compra) {
            $request->request->add(['data_ultima_compra_menor' => null]);
            $request->request->add(['data_ultima_compra_maior' => null]);
        }

        if (!$request->segmentar_mes_aniversario) {
            $request->request->add(['mes_aniversario' => null]);
            $request->request->add(['condicao_mes_aniversario' => null]);
        }

        if (!$request->segmentar_dia_aniversario) {
            $request->request->add(['dia_aniversario' => null]);
            $request->request->add(['condicao_dia_aniversario' => null]);
        }

        if (!$request->segmentar_saldo_pontos) {
            $request->request->add(['saldo_pontos' => null]);
            $request->request->add(['condicao_saldo_pontos' => null]);
        }

        if (!$request->segmentar_categorias) {
            $campanha->categorias()->sync([]);
        }
        else {
            $campanha->categorias()->sync($request->categorias);
        }

        if (!$request->segmentar_genero) {
            $request->request->add(['genero' => null]);
        }

        return null;
    }

}
