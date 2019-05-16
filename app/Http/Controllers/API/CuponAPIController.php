<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCuponAPIRequest;
use App\Http\Requests\API\UpdateCuponAPIRequest;
use App\Models\Cupon;
use App\Repositories\CuponRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CuponController
 * @package App\Http\Controllers\API
 */

class CuponAPIController extends AppBaseController
{
    /** @var  CuponRepository */
    private $cuponRepository;

    public function __construct(CuponRepository $cuponRepo)
    {
        $this->cuponRepository = $cuponRepo;
    }

    /**
     * Display a listing of the Cupon.
     * GET|HEAD /cupons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cuponRepository->pushCriteria(new RequestCriteria($request));
        $this->cuponRepository->pushCriteria(new LimitOffsetCriteria($request));

        //Atenção que o apareceListagem do repositorio precisa ser chamado antes!
        $cupons = $this->cuponRepository->apareceListagem()->with('fotos')->get();
        return $this->sendResponse($cupons->toArray(), 'Cupons carregados com sucesso');
    }

    /**
     * Store a newly created Cupon in storage.
     * POST /cupons
     *
     * @param CreateCuponAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCuponAPIRequest $request)
    {
        $input = $request->all();

        $cupons = $this->cuponRepository->create($input);

        return $this->sendResponse($cupons->toArray(), 'Cupom salvo com sucesso');
    }

    /**
     * Display the specified Cupon.
     * GET|HEAD /cupons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cupon = $this->cuponRepository->with('fotos')->findWithoutFail($id);

        if (empty($cupon)) {
            return $this->sendError('Cupom não encontrado');
        }

        return $this->sendResponse($cupon->toArray(), 'Cupom encontrado com sucesso');
    }

    /**
     * Update the specified Cupon in storage.
     * PUT/PATCH /cupons/{id}
     *
     * @param  int $id
     * @param UpdateCuponAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCuponAPIRequest $request)
    {
        $input = $request->all();

        $cupon = $this->cuponRepository->with('fotos')->findWithoutFail($id);

        if (empty($cupon)) {
            return $this->sendError('Cupom não encontrado');
        }

        $cupon = $this->cuponRepository->update($input, $id);

        return $this->sendResponse($cupon->toArray(), 'Cupom atualizado com sucesso');
    }

    /**
     * Remove the specified Cupon from storage.
     * DELETE /cupons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Cupon $cupon */
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            return $this->sendError('Cupom não encontrado');
        }

        if ($cupon->fotos) {
            $cupon->fotos()->delete();
        }

        if ($cupon->pessoas) {
            \DB::statement("DELETE FROM cupons_pessoas WHERE cupom_id = $cupon->id");
        }

        $cupon->delete();

        return $this->sendResponse($id, 'Cupom excluído com sucesso');
    }

    /**
     * Método que atribui um código único ao cupom e
     * o associa a uma pessoa
     *
     * @param $cupom_id id do cupom
     * @param $request Request com pessoa_id no input
     *
     * @return Cupom com o código recém gerado
     */
    public function ativar($cupom_id, Request $request)
    {
        $cupom = \App\Models\Cupon::with('fotos')->find($cupom_id);

        if (!$cupom) {
            return $this->sendError('Cupom não encontrado');
        }

        $pessoa_id = $request->input('pessoa_id');
        $pessoa = \App\Models\Pessoa::find($pessoa_id);

        if (!$pessoa) {
            return $this->sendError('Pessoa não encontrada');
        }

        if (!$pessoa->id_vestylle) {
            return $this->sendError('Identificador do usuário não encontrado no sistema da vestylle');
        }

        $cupom_ativado = \App\Models\CuponPessoa::jaFoiAtivado($pessoa_id, $cupom_id);

        if ($cupom_ativado) {
            return $this->sendResponse($cupom_ativado, 'O Cupom já está ativado');
        }

        $codigo_unico = $cupom->gerarCodigoUnico($pessoa->id_vestylle);
        $cupom->ativar($pessoa_id, $codigo_unico);

        $response = $cupom->toArray();
        $response['codigo_unico'] = $codigo_unico;

        return $this->sendResponse($response, 'Cupom ativado com sucesso');
    }

}
