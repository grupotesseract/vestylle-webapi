<?php

namespace App\Repositories;

use App\Models\Pessoa;
use InfyOm\Generator\Common\BaseRepository;
use Illuminate\Support\Facades\Hash;
/**
 * Class PessoaRepository
 * @package App\Repositories
 * @version February 21, 2019, 12:37 am UTC
 *
 * @method Pessoa findWithoutFail($id, $columns = ['*'])
 * @method Pessoa find($id, $columns = ['*'])
 * @method Pessoa first($columns = ['*'])
*/
class PessoaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_vestylle',
        'saldo_pontos',
        'celular',
        'telefone_fixo',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'nome',
        'cpf',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'complemento',
        'data_ultima_compra',
        'data_nascimento',
        'cidade_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pessoa::class;
    }

    /**
     * Traz infos do usuário logado no Facebook e atualiza Pessoa
     *
     * @return \Illuminate\Http\Response
     */
    public function trataInformacoesSocial($usuarioSocial)
    {
        $emailSocial = $usuarioSocial->getEmail();
        $pessoa = $this->firstOrNew(['email' => $emailSocial]);
        $pessoa->nome = $usuarioSocial->getName();
        $pessoa->social_token = $usuarioSocial->token;
        $pessoa->save();
        return $pessoa;
    }

    /**
     * Autenticação via API
     *     
     * @return \Illuminate\Http\Response
     * @return Response
     */
    public function login($pessoa, $request) 
    {            
        if (Hash::check($request->password, $pessoa->password)) {
            $token = $pessoa->createToken('Laravel Password Grant Client')->accessToken;
            $response = ['token' => $token];
            return $response;
        } else {
            return false;
        }            
    }
}
