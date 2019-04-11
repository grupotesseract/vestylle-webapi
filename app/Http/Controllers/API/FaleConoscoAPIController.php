<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaleConoscoAPIRequest;
use App\Http\Requests\API\UpdateFaleConoscoAPIRequest;
use App\Models\FaleConosco;
use App\Models\Loja;
use App\Models\Pessoa;
use App\Repositories\FaleConoscoRepository;
use App\Mail\FaleConoscoCreated;
use Illuminate\Support\Facades\Mail;
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

    public function __construct(FaleConoscoRepository $faleConoscoRepo, Loja $loja, Pessoa $pessoa)
    {
        $this->faleConoscoRepository = $faleConoscoRepo;
        $this->loja = $loja;
        $this->pessoa = $pessoa;
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

        return $this->sendResponse($faleConoscos->toArray(), 'Fale Conosco encontrado com sucesso');
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

        $lojaNome = $this->loja::findOrFail(1)->nome;

        $usuario = $this->pessoa::findOrFail($faleConoscos->pessoa_id)->nome;

        Mail::to($this->loja::findOrFail(1)->email)->send(new FaleConoscoCreated($faleConoscos, $lojaNome, $usuario));

        return $this->sendResponse($faleConoscos->toArray(), 'Fale Conosco salvo com sucesso');
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

        return $this->sendResponse($faleConosco->toArray(), 'Fale Conosco encontrado com sucesso');
    }
}
