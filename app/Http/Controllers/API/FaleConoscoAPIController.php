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

    public function __construct(FaleConoscoRepository $faleConoscoRepo)
    {
        $this->faleConoscoRepository = $faleConoscoRepo;
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

        //Se estiver logado, pegar id pra inserir no registro.
        $pessoaId = (\Auth('api')->user()) ? \Auth('api')->user()->id : null;
        $input['pessoa_id'] = $pessoaId;

        $faleConoscos = $this->faleConoscoRepository->create($input);

        Mail::to(env('EMAIL_DESTINO_CONTATO'))
            ->send(new FaleConoscoCreated($faleConoscos));

        return $this->sendResponse($faleConoscos->toArray(), 'Fale Conosco salvo com sucesso');
    }

}
