<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\CreateOfertaAPIRequest;
use App\Http\Requests\API\UpdateOfertaAPIRequest;
use App\Models\Oferta;
use App\Repositories\OfertaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OfertaController
 * @package App\Http\Controllers\API
 */

class OfertaAPIController extends AppBaseController
{
    /** @var  OfertaRepository */
    private $ofertaRepository;

    public function __construct(OfertaRepository $ofertaRepo)
    {
        $this->ofertaRepository = $ofertaRepo;
    }

    /**
     * Display a listing of the Oferta.
     * GET|HEAD /ofertas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ofertaRepository->pushCriteria(new RequestCriteria($request));
        $this->ofertaRepository->pushCriteria(new LimitOffsetCriteria($request));

        $pessoa = Auth('api')->user();

        $ofertas = $this->ofertaRepository->apareceListagem($pessoa);

        return $this->sendResponse($ofertas->toArray(), 'Ofertas encontradas com sucesso');
    }

    /**
     * Store a newly created Oferta in storage.
     * POST /ofertas
     *
     * @param CreateOfertaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOfertaAPIRequest $request)
    {
        $input = $request->all();

        $ofertas = $this->ofertaRepository->create($input);

        return $this->sendResponse($ofertas->toArray(), 'Oferta salva com sucesso');
    }

    /**
     * Display the specified Oferta.
     * GET|HEAD /ofertas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Oferta $oferta */
        $oferta = $this->ofertaRepository->with(['cupons', 'fotos'])->findWithoutFail($id);

        if (empty($oferta)) {
            return $this->sendError('Oferta not found');
        }

        return $this->sendResponse($oferta->toArray(), 'Oferta encontrada com sucesso');
    }

    /**
     * Update the specified Oferta in storage.
     * PUT/PATCH /ofertas/{id}
     *
     * @param  int $id
     * @param UpdateOfertaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfertaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Oferta $oferta */
        $oferta = $this->ofertaRepository->with('fotos')->findWithoutFail($id);

        if (empty($oferta)) {
            return $this->sendError('Oferta not found');
        }

        $oferta = $this->ofertaRepository->update($input, $id);

        return $this->sendResponse($oferta->toArray(), 'Oferta atualizada com sucesso');
    }

    /**
     * Remove the specified Oferta from storage.
     * DELETE /ofertas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Oferta $oferta */
        $oferta = $this->ofertaRepository->findWithoutFail($id);

        if (empty($oferta)) {
            return $this->sendError('Oferta not found');
        }

        $oferta->delete();

        return $this->sendResponse($id, 'Oferta excluída com sucesso');
    }
}
