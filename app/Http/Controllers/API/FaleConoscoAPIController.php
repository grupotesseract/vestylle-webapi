<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaleConoscoAPIRequest;
use App\Http\Requests\API\UpdateFaleConoscoAPIRequest;
use App\Models\FaleConosco;
use App\Repositories\FaleConoscoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FaleConoscoController
 * @package App\Http\Controllers\API
 */

class FaleConoscoAPIController extends AppBaseController
{
    /** @var  FaleConoscoRepository */
    private $faleConoscoRepository;

    public function __construct(FaleConoscoRepository $faleConoscoRepo)
    {
        $this->faleConoscoRepository = $faleConoscoRepo;
    }

    /**
     * Display a listing of the FaleConosco.
     * GET|HEAD /faleConoscos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->faleConoscoRepository->pushCriteria(new RequestCriteria($request));
        $this->faleConoscoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $faleConoscos = $this->faleConoscoRepository->all();

        return $this->sendResponse($faleConoscos->toArray(), 'Fale Conoscos retrieved successfully');
    }

    /**
     * Store a newly created FaleConosco in storage.
     * POST /faleConoscos
     *
     * @param CreateFaleConoscoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFaleConoscoAPIRequest $request)
    {
        $input = $request->all();

        $faleConoscos = $this->faleConoscoRepository->create($input);

        return $this->sendResponse($faleConoscos->toArray(), 'Fale Conosco saved successfully');
    }

    /**
     * Display the specified FaleConosco.
     * GET|HEAD /faleConoscos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var FaleConosco $faleConosco */
        $faleConosco = $this->faleConoscoRepository->findWithoutFail($id);

        if (empty($faleConosco)) {
            return $this->sendError('Fale Conosco not found');
        }

        return $this->sendResponse($faleConosco->toArray(), 'Fale Conosco retrieved successfully');
    }

    /**
     * Update the specified FaleConosco in storage.
     * PUT/PATCH /faleConoscos/{id}
     *
     * @param  int $id
     * @param UpdateFaleConoscoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaleConoscoAPIRequest $request)
    {
        $input = $request->all();

        /** @var FaleConosco $faleConosco */
        $faleConosco = $this->faleConoscoRepository->findWithoutFail($id);

        if (empty($faleConosco)) {
            return $this->sendError('Fale Conosco not found');
        }

        $faleConosco = $this->faleConoscoRepository->update($input, $id);

        return $this->sendResponse($faleConosco->toArray(), 'FaleConosco updated successfully');
    }

    /**
     * Remove the specified FaleConosco from storage.
     * DELETE /faleConoscos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var FaleConosco $faleConosco */
        $faleConosco = $this->faleConoscoRepository->findWithoutFail($id);

        if (empty($faleConosco)) {
            return $this->sendError('Fale Conosco not found');
        }

        $faleConosco->delete();

        return $this->sendResponse($id, 'Fale Conosco deleted successfully');
    }
}
