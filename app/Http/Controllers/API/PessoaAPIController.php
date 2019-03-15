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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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

        return $this->sendResponse($pessoas->toArray(), 'Pessoas retrieved successfully');
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

        $pessoas = $this->pessoaRepository->create($input);

        return $this->sendResponse($pessoas->toArray(), 'Pessoa saved successfully');
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
            return $this->sendError('Pessoa not found');
        }

        return $this->sendResponse($pessoa->toArray(), 'Pessoa retrieved successfully');
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
            return $this->sendError('Pessoa not found');
        }

        $pessoa = $this->pessoaRepository->update($input, $id);

        return $this->sendResponse($pessoa->toArray(), 'Pessoa updated successfully');
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
            return $this->sendError('Pessoa not found');
        }

        $pessoa->delete();

        return $this->sendResponse($id, 'Pessoa deleted successfully');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $usuarioSocial = Socialite::driver('facebook')->stateless()->user();
        $emailSocial = $usuarioSocial->getEmail();
        $pessoa = $this->pessoaRepository->firstOrNew(['email' => $emailSocial]);
        $pessoa->nome = $usuarioSocial->getName();
        $pessoa->social_token = $usuarioSocial->token;
        $pessoa->save();
        //dump($pessoa);        
    }

    /**
     * Autenticação via API
     *     
     *
     * @return Response
     */
    public function login(Request $request) {

        $pessoa = $this->pessoaRepository->findByField('email', $request->email)->first();
    
        if ($pessoa) {    
            if (Hash::check($request->password, $pessoa->password)) {
                $token = $pessoa->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = "A senha digitada está incorreta";
                return response($response, 422);
            }    
        } else {
            $response = 'Usuário inexistente';
            return response($response, 422);
        }    
    }
}
