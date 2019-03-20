<?php

namespace App\Repositories;

use App\Models\Pessoa;
use App\Helpers\VestylleDBHelper;
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

    /**
     * Metodo para criar uma Pessoa com as infos da Vestylle a partir do CPF
     *
     * @return Pessoa || false
     */
    public function createFromVestylle($cpf)
    {
        $retornoVestylle = $this->vestylleDB->getPessoa($cpf);
        $pessoa = is_array($retornoVestylle) ? array_shift($retornoVestylle) : false;

        if (!$pessoa || !is_object($pessoa)) {
            return false;
        }

        $Cidade = \Cidade::where('nome_sanitized', $this->sanitizeString($pessoa->cidade))->first();
        $cidadeId = $Cidade ? $Cidade->id : null;

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

        return $result;
    }

    /**
     * Metodo para fazer update dos dados de uma Pessoa com as infos da Vestylle
     *
     * @param Pessoa $pessoaObj
     * @return boolean - Se o update ocorreu.
     */
    public function updateFromVestylle(Pessoa $pessoaObj)
    {
        $retornoVestylle = $this->vestylleDB->getPessoa($pessoaObj->cpf);
        $pessoa = is_array($retornoVestylle) ? array_shift($retornoVestylle) : false;

        if (!$pessoa || !is_object($pessoa)) {
            return false;
        }

        $Cidade = \Cidade::where('nome_sanitized', $this->sanitizeString($pessoa->cidade))->first();
        $cidadeId = $Cidade ? $Cidade->id : null;

        $result = $pessoaObj->update([
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

        return $result;
    }

    /**
     * Atualiza o saldo de pontos de uma Pessoa
     *
     * @param Pessoa $pessoa
     */
    public function updatePontosPessoa(Pessoa $pessoa)
    {
        $result = $this->vestylleDB->getSaldoPontosPessoa($pessoa);

        //Se vier result, for array, nao estiver vazio e o objeto tiver a propriedade SALDO
        if ($result && is_array($result) && !empty($result) && property_exists($result[0], 'SALDO')) {
            $updated = $pessoa->update([
                'saldo_pontos' => $result[0]->{"SALDO"}
            ]);

            return $updated;
        }

        return false;
    }

    /**
     * Atualiza a data de vencimento dos pontos.
     * Pega a data mais proxima caso existam varias.
     *
     * @param Pessoa $pessoa
     */
    public function updateVencimentoPontosPessoa(Pessoa $pessoa)
    {
        $result = $this->vestylleDB->getVencimentoPontosPessoa($pessoa);

        //Se vier result, for array, nao estiver vazio e o objeto tiver a propriedade VENCIMENTO
        if ($result && is_array($result) && !empty($result) && property_exists($result[0], 'VENCIMENTO')) {
            $updated = $pessoa->update([
                'data_vencimento_pontos' => $result[0]->{"VENCIMENTO"}
            ]);

            return $updated;
        }

        return false;
    }

    /**
     * Atualiza a data da ultima compra de uma pessoa
     *
     * @param Pessoa $pessoa
     */
    public function updateDataUltimaCompraPessoa(Pessoa $pessoa)
    {
        $result = $this->vestylleDB->getDataUltimaCompraPessoa($pessoa);

        //Se vier result, for array, nao estiver vazio e o objeto tiver a propriedade CNSCADMOM
        if ($result && is_array($result) && !empty($result) && property_exists($result[0], 'CNSCADMOM')) {
            $updated = $pessoa->update([
                'data_ultima_compra' => $result[0]->{"CNSCADMOM"}
            ]);

            return $updated;
        }

        return false;
    }

    /**
     * Metodo para remover acentos / caracteres especiais e retornar a string lowercase
     *
     * @param mixed $str
     * @return string - string minuscula sem acentos ou caracteres especiais
     */
    public function sanitizeString($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        return strtolower($str);
    }

    /**
     * Metodo para atualizar as Pessoas que foram alteradas no BD da vestylle e já estiverem no nosso BD
     *
     * @return void
     */
    public function updatePessoasAtualizadasVestylle($tipoLimite=VestylleDBHelper::LIMITE_DIAS, $valorLimite=2)
    {
        //Pega todas as pessoas alteradas lá no periodo especificado
        $retornoVestylle = $this->vestylleDB->getPessoasAtualizadas($tipoLimite, $valorLimite);

        if (!is_array($retornoVestylle)) {
            return false;
        }

        //Filtrando retorno pelos id_vestylle que temos aqui
        $idsVestylle = Pessoa::pluck('id_vestylle')->all();
        $pessoasParaAtualizar = collect($retornoVestylle)->whereIn('idpessoa', $idsVestylle);

        //Iterando, atrelando a cidade no BD (qnd existir) e salvando
        foreach ($pessoasParaAtualizar as $pessoa) {
            $Cidade = \Cidade::where('nome_sanitized', $this->sanitizeString($pessoa->cidade))->first();
            $cidadeId = $Cidade ? $Cidade->id : null;
            $queryPessoaCPF = Pessoa::where('id_vestylle', $pessoa->idpessoa);

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
            }
        }

        return count($pessoasParaAtualizar);
    }
}
