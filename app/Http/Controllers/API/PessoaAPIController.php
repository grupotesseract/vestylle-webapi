<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePessoaAPIRequest;
use App\Http\Requests\API\UpdatePessoaAPIRequest;
use App\Models\Pessoa;
use App\Repositories\PessoaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Socialite;

/**
 * Class PessoaController
 * @package App\Http\Controllers\API
 */

class PessoaAPIController extends AppBaseController
{
    /** @var  PessoaRepository */
    private $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepo)
    {
        $this->pessoaRepository = $pessoaRepo;
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

        $pessoa = $this->pessoaRepository->create($input);
        $pessoa->password = bcrypt($request->password);
        $pessoa->save();        

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

        $pessoa->delete();

        return $this->sendResponse($id, 'Pessoa excluída com sucesso');
    }

    /**
     * Autenticação via Facebook - Redireciona usuário para página do Face.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirecionaSocial()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function trataInformacoesSocial()
    {
        $usuarioSocial = Socialite::driver('facebook')->stateless()->user();
        $pessoa = $this->pessoaRepository->trataInformacoesSocial($usuarioSocial);
        return $this->sendResponse($pessoa->toArray(), 'Usuário autenticou no Facebook com Sucesso');
    }

    /**
     * Autenticação via API
     *     
     * @return \Illuminate\Http\Response
     * @return Response
     */
    public function login(Request $request) 
    {
        $pessoa = $this->pessoaRepository->findByField('email', $request->email)->first();
    
        if ($pessoa) {
            $token = $this->pessoaRepository->login($pessoa, $request);    
            if ($token) {
                return $this->sendResponse($token, 'Usuário autenticou via API com Sucesso');                
            } else {  
                return $this->sendError('A senha digitada está incorreta');
            }             
        } else {  
            return $this->sendError('Usuário inexistente');
        }    
    }
}
