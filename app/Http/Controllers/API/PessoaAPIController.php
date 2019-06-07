<?php

namespace App\Http\Controllers\API;

use Response;
use Socialite;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Repositories\PessoaRepository;
use App\Repositories\OfertaRepository;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\API\CreatePessoaAPIRequest;
use App\Http\Requests\API\UpdatePessoaAPIRequest;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


/**
 * Class PessoaController
 * @package App\Http\Controllers\API
 */

class PessoaAPIController extends AppBaseController
{
    use SendsPasswordResetEmails;
    
    /** @var  PessoaRepository */
    private $pessoaRepository;
    private $ofertaRepository;

    public function __construct(PessoaRepository $pessoaRepo, OfertaRepository $ofertaRepo)
    {
        $this->pessoaRepository = $pessoaRepo;
        $this->ofertaRepository = $ofertaRepo;
    }    

    /**
     * Display a listing of the Pessoa.
     * GET|HEAD /pessoas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pessoaRepository->pushCriteria(new RequestCriteria($request));
        $this->pessoaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pessoas = $this->pessoaRepository->all();

        return $this->sendResponse($pessoas->toArray(), 'Pessoas encontrada com sucesso');
    }

    /**
     * Store a newly created Pessoa in storage.
     * POST /pessoas
     *
     * @param CreatePessoaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePessoaAPIRequest $request)
    {
        $input = $request->all();

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $input['cpf'] = $request->email;
            $input['email'] = null;

            $pessoa = $this->pessoaRepository->findByField(['cpf' => $input['cpf']]);

            if ($pessoa->count() > 0) {
                return $this->sendError('Este CPF já está cadastrado!');
            }
        }

        $pessoa = $this->pessoaRepository->create($input);
        $pessoa->password = bcrypt($request->password);
        $pessoa->save();

        $pegouDadosVestylle = $this->pessoaRepository->updateFromVestylle($pessoa);

        //Se tem id_vestylle --> Pegar Pontos, Vencimento dos Pontos e Data de ultima compra da pessoa
        if ($pegouDadosVestylle) {
            $this->pessoaRepository->updatePontosPessoa($pessoa);
            $this->pessoaRepository->updateVencimentoPontosPessoa($pessoa);
            $this->pessoaRepository->updateDataUltimaCompraPessoa($pessoa);
            $this->pessoaRepository->updateNascimentoPessoa($pessoa);
            $this->pessoaRepository->updateSegmentos($pessoa);
        }

        $token = $this->pessoaRepository->login($pessoa, $request);

        return $this->sendResponse(
            [
                'pessoa' => $pessoa->toArray(),
                'token' => $token
            ],
            'Pessoa criada com sucesso'
        );
    }

    /**
     * Display the specified Pessoa.
     * GET|HEAD /pessoas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pessoa $pessoa */
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            return $this->sendError('Pessoa não encontrada');
        }

        return $this->sendResponse($pessoa->toArray(), 'Pessoa encontrada com sucesso');
    }

    /**
     * Update the specified Pessoa in storage.
     * PUT/PATCH /pessoas/{id}
     *
     * @param  int $id
     * @param UpdatePessoaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePessoaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pessoa $pessoa */
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            return $this->sendError('Pessoa não encontrada');
        }

        $pessoa = $this->pessoaRepository->update($input, $id);

        $pegouDadosVestylle = $this->pessoaRepository->updateFromVestylle($pessoa);

        //Se tem id_vestylle --> Pegar Pontos, Vencimento dos Pontos e Data de ultima compra da pessoa
        if ($pegouDadosVestylle) {
            $this->pessoaRepository->updatePontosPessoa($pessoa);
            $this->pessoaRepository->updateVencimentoPontosPessoa($pessoa);
            $this->pessoaRepository->updateDataUltimaCompraPessoa($pessoa);
            $this->pessoaRepository->updateNascimentoPessoa($pessoa);
            $this->pessoaRepository->updateSegmentos($pessoa);
        }

        return $this->sendResponse($pessoa->toArray(), 'Pessoa atualizada com sucesso');
    }

    /**
     * Remove the specified Pessoa from storage.
     * DELETE /pessoas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pessoa $pessoa */
        $pessoa = $this->pessoaRepository->findWithoutFail($id);

        if (empty($pessoa)) {
            return $this->sendError('Pessoa não encontrada');
        }

        if ($pessoa->cupons) {
            \DB::statement("DELETE FROM cupons_pessoas WHERE pessoa_id = $pessoa->id");
        }

        $pessoa->delete();

        return $this->sendResponse($id, 'Pessoa excluída com sucesso');
    }

    /**
     * Autenticação via Facebook - Redireciona usuário para página do Face.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirecionaSocial(Request $request)
    {
        $pessoa = $this->pessoaRepository->trataInformacoesSocial($request);
        if ($pessoa) {
            $token = $pessoa->createToken('Laravel Password Grant Client')->accessToken;
            return $this->sendResponse(
                [
                    'pessoa' => $pessoa->toArray(),
                    'token' => $token
                ],
                'Usuário autenticou via API com Sucesso'
            );
        } else {
            return $this->sendError('Usuário inexistente');
        }

    }

    /**
     * Autenticação via API
     *
     * @return \Illuminate\Http\Response
     * @return Response
     */
    public function login(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $pessoa = $this->pessoaRepository->findByField('email', $request->email)->first();
        } else {
            $pessoa = $this->pessoaRepository->findByField('cpf', $request->email)->first();
        }

        if ($pessoa) {
            $token = $this->pessoaRepository->login($pessoa, $request);
            if ($token) {
                return $this->sendResponse(
                    [
                        'pessoa' => $pessoa->toArray(),
                        'token' => $token
                    ],
                    'Usuário autenticou via API com Sucesso'
                );
            } else {
                return $this->sendError('A senha digitada está incorreta');
            }
        } else {
            return $this->sendError('Usuário inexistente');
        }
    }

    /**
     * Metodo para retornar as Ofertas que foram adicinadas a lista de desejos da $idPessoa
     *
     * @param mixed $idPessoa
     */
    public function getOfertas($id)
    {
        if (Auth::user()->id == $id) {
            $pessoa = $this->pessoaRepository->findWithoutFail($id);

            if ($pessoa) {
                return $this->sendResponse(
                    [
                        'ofertas' => $pessoa->listaDesejos->toArray(),
                    ],
                    'Listagem das Ofertas adicinadas á lista de desejos'
                );
            } else {
                return $this->sendError('Pessoa não encontrada');
            }
        } else {
            return $this->sendError('Pessoa não encontrada');
        }

    }

    /**
     * Metodo para associar/desassociar uma oferta a uma pessoa
     *
     * @param mixed $idPessoa
     */
    public function postOfertas(Request $request, $id)
    {
        if (Auth::user()->id == $id) {
            $pessoa = $this->pessoaRepository->findWithoutFail($id);

            if ($pessoa) {

                $oferta = $this->ofertaRepository->findWithoutFail($request->oferta_id);
                if (!$oferta) {
                    return $this->sendError('Oferta não encontrada');
                }

                $result = $this->pessoaRepository->toggleOfertaListaDesejo($pessoa, $oferta);
                if ($result) {
                    return $this->sendResponse(
                        [
                            'ofertas' => $pessoa->listaDesejos->toArray(),
                        ],
                        'Oferta adicionada a lista de desejos com sucesso!'
                    );
                } else {
                    return $this->sendResponse(
                        [
                            'ofertas' => $pessoa->listaDesejos->toArray(),
                        ],
                        'Oferta removida da lista de desejos com sucesso!'
                    );

                }

            } else {
                return $this->sendError('Pessoa não encontrada');
            }
        } else {
            return $this->sendError('Pessoa não encontrada');
        }


    }

    /**
     * Retorna a listagem dos cupons que a pessoa ativou
     *
     * @param $pessoa_id id da pessoa
     *
     * @return Response || Error
     */
    public function getCuponsUtilizados($pessoa_id)
    {
        $pessoa = $this->pessoaRepository->findWithoutFail($pessoa_id);

        if (empty($pessoa)) {
            return $this->sendError('Pessoa não encontrada');
        }

        $cuponsUtilizados = $pessoa->cupons()->NaoUtilizadoVenda($pessoa)->get()->toArray();

        return $this->sendResponse($cuponsUtilizados, "Cupons do usuário #$pessoa->id carregados com sucesso");
    }

}
