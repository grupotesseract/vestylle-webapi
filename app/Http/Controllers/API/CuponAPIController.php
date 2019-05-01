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
        $cupons = $this->cuponRepository->all();

        return $this->sendResponse($cupons->toArray(), 'Cupom encontrado com sucesso');
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
        /** @var Cupon $cupon */
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            return $this->sendError('Cupon not found');
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

        /** @var Cupon $cupon */
        $cupon = $this->cuponRepository->findWithoutFail($id);

        if (empty($cupon)) {
            return $this->sendError('Cupon not found');
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
            return $this->sendError('Cupon not found');
        }

        if ($cupon->fotos) {
            $cupon->fotos()->delete();
        }

        $cupon->delete();

        return $this->sendResponse($id, 'Cupom excluído com sucesso');
    }
}
