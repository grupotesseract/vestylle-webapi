<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
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

        $pessoa = Auth('api')->user();
        //Atenção que o apareceListagem do repositorio precisa ser chamado antes!
        $cupons = $this->cuponRepository->apareceListagem($pessoa);
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
        $pessoa = Auth('api')->user();
        $pessoa_id = $pessoa->id;

        $cupon = $this->cuponRepository->with(
            [
                'pessoas' => function ($query) use ($pessoa_id) {
                    $query->where('pessoa_id', $pessoa_id);
                }
            ]
        )->findWithoutFail($id);

        if (empty($cupon)) {
            return $this->sendError('Cupom não encontrado');
        }

        //Se a pessoa tiver ativado esse cupom, substituir data_validade por data_expiracao
        if ($cupon->pessoas->count()) {
            $cupon->data_validade = $cupon->pessoas->first()->pivot->data_expiracao;
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

        //Pegando pessoa a partir do token da request
        $pessoa = \Auth::user();
        $pessoa_id = $pessoa->id;

        if (!$pessoa) {
            return $this->sendError('Pessoa não encontrada');
        }

        if (!$pessoa->id_vestylle) {
            return $this->sendError('Identificador do usuário não encontrado no sistema da vestylle');
        }

        //SE encontrar o cupom a partir da pessoa, então ja foi ativado
        $cupom_ativado = $pessoa->cupons()
            ->withPivot('data_expiracao')
            ->withPivot('codigo_unico')
            ->find($cupom_id);

        if ($cupom_ativado) {
            $cupom_ativado->data_validade = $cupom_ativado->pivot->data_expiracao;
            return $this->sendResponse($cupom_ativado, 'O Cupom já está ativado');
        }

        $codigo_unico = $cupom->gerarCodigoUnico($pessoa->id_vestylle);
        $cupomAtivado = $cupom->ativar($pessoa_id, $codigo_unico);

        $response = $cupom->toArray();
        $response['codigo_unico'] = $codigo_unico;
        $response['data_expiracao'] = $cupomAtivado->data_expiracao;
        $response['data_validade'] = $cupomAtivado->data_expiracao->format('Y-m-d H:i:s');

        return $this->sendResponse($response, 'Cupom ativado com sucesso');
    }

    /**
     * Display the specified Cupon.
     * GET|HEAD /cupons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showEncryptado($idEncryptado)
    {
        $cupon = $this->cuponRepository->findEncryptadoWithoutFail($idEncryptado);

        //Se nao encontrar pelo 'qrcode' procurar pelo codigo_amigavel
        if (empty($cupon)) {
            $cupon = $this->cuponRepository->findByCodigoAmigavel($idEncryptado);
        }

        //Se nao encontrar denovo, ai deu ruim
        if (empty($cupon)) {
            return $this->sendError('Cupom não encontrado');
        }

        return $this->sendResponse($cupon->toArray(), 'Cupom encontrado com sucesso');
    }

}
