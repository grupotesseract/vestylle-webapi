<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLojaAPIRequest;
use App\Http\Requests\API\UpdateLojaAPIRequest;
use App\Models\Loja;
use App\Repositories\LojaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LojaController
 * @package App\Http\Controllers\API
 */

class LojaAPIController extends AppBaseController
{
    /** @var  LojaRepository */
    private $lojaRepository;

    public function __construct(LojaRepository $lojaRepo)
    {
        $this->lojaRepository = $lojaRepo;
    }

    /**
     * Display a listing of the Loja.
     * GET|HEAD /lojas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lojaRepository->pushCriteria(new RequestCriteria($request));
        $this->lojaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $lojas = $this->lojaRepository->all();

        return $this->sendResponse($lojas->toArray(), 'Lojas retrieved successfully');
    }

    /**
     * Store a newly created Loja in storage.
     * POST /lojas
     *
     * @param CreateLojaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLojaAPIRequest $request)
    {
        $input = $request->all();

        $lojas = $this->lojaRepository->create($input);

        return $this->sendResponse($lojas->toArray(), 'Loja saved successfully');
    }

    /**
     * Display the specified Loja.
     * GET|HEAD /lojas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show()
    {
        /** @var Loja $loja */
        $loja = $this->lojaRepository->first();

        if (empty($loja)) {
            return $this->sendError('Loja not found');
        }

        return $this->sendResponse($loja->toArray(), 'Loja retrieved successfully');
    }

    /**
     * Update the specified Loja in storage.
     * PUT/PATCH /lojas/{id}
     *
     * @param  int $id
     * @param UpdateLojaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLojaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Loja $loja */
        $loja = $this->lojaRepository->findWithoutFail($id);

        if (empty($loja)) {
            return $this->sendError('Loja not found');
        }

        $loja = $this->lojaRepository->update($input, $id);

        return $this->sendResponse($loja->toArray(), 'Loja updated successfully');
    }

    /**
     * Remove the specified Loja from storage.
     * DELETE /lojas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Loja $loja */
        $loja = $this->lojaRepository->findWithoutFail($id);

        if (empty($loja)) {
            return $this->sendError('Loja not found');
        }

        if ($loja->fotos) {
            $loja->fotos()->delete();
        }

        $loja->delete();

        return $this->sendResponse($id, 'Loja deleted successfully');
    }
}
