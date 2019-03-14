<?php

namespace App\Helpers;

use App\Models\Pessoa;

/**
 * Class VestylleDBHelper - Classe para centralizar a intermediação com o DB da vestylle;
 */
class VestylleDBHelper
{
    private $connection;

    const LIMITE_HORAS = "NOW() - INTERVAL # HOUR";
    const LIMITE_DIAS = "NOW() - INTERVAL # DAY";

    /**
     * Construtor testando a conexão com o BD da vestylle.
     */
    public function __construct()
    {
        $this->connection = \DB::connection('vestylle');

        try {
            $this->connection->getPdo();
        }
        catch(\Exception $e) {
            $msg = "[ERRO] Não foi possivel conectar com o BD da vestylle o .env tem as variaveis:\n
                VESTYLLE_DB_HOST, VESTYLLE_DB_PORT, VESTYLLE_DB_DATABASE, VESTYLLE_DB_USERNAME, VESTYLLE_DB_PASSWORD?\n
                Exception interna: \n" . $e->getMessage();

            throw new \Exception($msg);
        }
    }

    /**
     * Metodo para retornar o connector para fazer queries no BD da vestylle
     *
     * @return Illuminate\Database\MySqlConnection
     */
    public function query()
    {
        return $this->connection;
    }

    /**
     * Metodo para obter as pessoas novas o BD da Vestylle.
     *
     * Pode ser passado parametros para limitar a query em $valorLimite de dias || horas.
     *
     * @param mixed $tipoLimite - Limite da query [self::LIMITE_DIAS || self::LIMITE_HORAS]
     * @param int $valorLimite - Valor do limite.
     */
    public function getPessoasNovas($tipoLimite=null, $valorLimite=2)
    {
        $query = "SELECT idpessoa, celular, fone, nome, cnpj_cpf, email, cep, cidade, endereco, numero, bairro, complement FROM pessoa WHERE fis_jur = 'F'" ;

        //Se for especificado algum limite, incluir na query.
        if ($tipoLimite) {
            $query .= " AND CNSCADMOM > " . str_replace("#", $valorLimite, $tipoLimite);
        }

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter pessoas novas. Log: " . $e->getMessage());
            return false;
        }

        //Iterando, atrelando a cidade no BD (qnd existir) e salvando
        foreach ($result as $pessoa) {

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
            }

            //Se não existir uma Pessoa com o CPF, criar
            else {
                Pessoa::create([
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

        return count($result);
    }

    /**
     * Metodo para obter as pessoas que foram atualizadas do BD da Vestylle.
     *
     * Pode ser passado parametros para limitar a query em $valorLimite de dias || horas.
     *
     * @param mixed $tipoLimite - Limite da query [self::LIMITE_DIAS || self::LIMITE_HORAS]
     * @param int $valorLimite - Valor do limite.
     */
    public function getPessoasAtualizadas($tipoLimite=null, $valorLimite=2)
    {
        $query = "SELECT idpessoa, celular, fone, nome, cnpj_cpf, email, cep, cidade, endereco, numero, bairro, complement FROM pessoa WHERE fis_jur = 'F'" ;

        //Se for especificado algum limite, incluir na query.
        if ($tipoLimite) {
            $query .= " AND CNSALTMOM > " . str_replace("#", $valorLimite, $tipoLimite);
        }

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter pessoas atualizadas. Log: " . $e->getMessage());
            return false;
        }

        //Iterando, atrelando a cidade no BD (qnd existir) e salvando
        foreach ($result as $pessoa) {

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
            }
        }
        return count($result);
    }

    /**
     * Metodo para obter o saldo de pontos de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return true || false - Se funcionou o update da $pessoa ou não
     */
    public function getSaldoPontosPessoa(Pessoa $pessoa)
    {
        $query = "SELECT SALDO from vegas_teste.fidmovim WHERE DONOID = $pessoa->id_vestylle ORDER BY CNSCADMOM DESC LIMIT 1" ;

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter saldo de uma pessoa. Log: " . $e->getMessage());
            return false;
        }

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
     * Metodo para obter a data de vencimento dos pontos de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return true || false - Se funcionou o update da $pessoa ou não
     */
    public function getVencimentoPontosPessoa(Pessoa $pessoa)
    {
        $query = "SELECT VENCIMENTO from vegas_teste.fidmovim WHERE DONOID = $pessoa->id_vestylle AND VENCIMENTO >= NOW() ORDER BY VENCIMENTO ASC LIMIT 1" ;

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter data de vencimento dos pontos de uma pessoa. Log: " . $e->getMessage());
            return false;
        }

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
     * Metodo para obter a data da ultima compra de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return true || false - Se funcionou o update da $pessoa ou não
     */
    public function getDataUltimaCompraPessoa(Pessoa $pessoa)
    {
        $query = "SELECT CNSCADMOM from vegas_teste.cxmovim WHERE pessoa = $pessoa->id_vestylle ORDER BY CNSCADMOM DESC LIMIT 1" ;

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter a data da ultima compra de uma pessoa. Log: " . $e->getMessage());
            return false;
        }

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
    public function sanitizeString($str) {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        return strtolower($str);
    }
}


