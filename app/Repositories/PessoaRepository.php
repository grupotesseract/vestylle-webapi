<?php

namespace App\Repositories;

use App\Models\Pessoa;
use InfyOm\Generator\Common\BaseRepository;

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
    private $vestylleDB;

    /**
     * @param mixed
     */
    public function __construct()
    {
        $this->vestylleDB = new \App\Helpers\VestylleDBHelper();
    }


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
     * Metodo para criar uma Pessoa com as infos da Vestylle a partir do CPF
     *
     * @return Pessoa || false
     */
    public function createOrUpdateFromVestylle($cpf)
    {
        $retornoVestylle = $this->vestylleDB->getPessoa($cpf);
        $pessoa = is_array($retornoVestylle) ? array_shift($retornoVestylle) : false;

        if (!$pessoa || !is_object($pessoa)) {
            return false;
        }

        $Cidade = \Cidade::where('nome_sanitized', $this->sanitizeString($pessoa->cidade))->first();
        $cidadeId = $Cidade ? $Cidade->id : null;
        $queryPessoaCPF = Pessoa::where('cpf', 'like', "%$pessoa->cnpj_cpf%");

        //Se existir uma Pessoa com o CPF na base, fazer update
        if ($queryPessoaCPF->count()) {
            $queryPessoaCPF->first()->update([
                'id_vestylle'  => $pessoa->idpessoa,
                "celular" => $pessoa->celular,
                "fone" => $pessoa->fone,
                "nome" => $pessoa->nome,
                "cpf" => $pessoa->cnpj_cpf,
                "email" => $pessoa->email,
                "cep" => $pessoa->cep,
                "endereco" => $pessoa->endereco,
                "numero" => $pessoa->numero,
                "bairro" => $pessoa->bairro,
                "cidade_id" => $cidadeId,
                "complemento" => $pessoa->complement,
            ]);
        } else {
            $result = Pessoa::create([
                'id_vestylle'  => $pessoa->idpessoa,
                "celular" => $pessoa->celular,
                "fone" => $pessoa->fone,
                "nome" => $pessoa->nome,
                "cpf" => $pessoa->cnpj_cpf,
                "email" => $pessoa->email,
                "cep" => $pessoa->cep,
                "endereco" => $pessoa->endereco,
                "numero" => $pessoa->numero,
                "bairro" => $pessoa->bairro,
                "cidade_id" => $cidadeId,
                "complemento" => $pessoa->complement,
            ]);
        }

        return $result;
    }




}
