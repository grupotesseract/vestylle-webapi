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
    //const CATEGORIAS = "'ESTILO','HOBBY','NUNCALC','PRTBAIXO','PRTCIMA'";

    /**
     * Construtor testando a conexão com o BD da vestylle.
     */
    public function __construct()
    {
        $this->connection = \DB::connection('vestylle');

        try {
            $this->connection->getPdo();
        } catch (\Exception $e) {
            $msg = "[ERRO] Não foi possivel conectar com o BD da Vestylle.  o .env tem as variaveis:\n
                Exception interna: " . $e->getMessage();

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
     * Metodo para obter os dados de 1 pessoa a partir do cpf
     *
     * @param mixed $cpf - numeros sem pontuacao
     * @return array || false - O resultado da query ou false.
     */
    public function getPessoa($cpf)
    {
        $query = "SELECT idpessoa, celular, fone, nome, cnpj_cpf, email, cep, cidade, endereco, numero, bairro, complement FROM pessoa WHERE fis_jur = 'F' AND cnpj_cpf = '$cpf'";

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter pessoas novas. Log: " . $e->getMessage());
            return false;
        }

        return $result;
    }

    /**
     * Metodo para obter as pessoas que foram atualizadas do BD da Vestylle.
     * Pode ser passado parametros para limitar a query em $valorLimite de dias || horas.
     *
     * @param mixed $tipoLimite - Limite da query [self::LIMITE_DIAS || self::LIMITE_HORAS]
     * @param int $valorLimite - Valor do limite.
     * @return array || false - O resultado da query ou false.
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

        return $result;
    }

    /**
     * Método pra trazer categorias cadastradas na base Vestylle
     *
     * @return array || false - O resultado da query ou false
     */
    public function getCategorias()
    {
        $tipoInformacoes = \App\Models\TipoInformacao::pluck('tipo_informacao')->toArray();
        $tipoInformacoesSplit = implode('", "', $tipoInformacoes);        
        $query = "SELECT DISTINCT TIPOINFO as descricao, DESCRICAO as conteudo, VALOR
                    as valor FROM vegas_teste.pesinfo 
                    WHERE TIPOINFO IN (\"$tipoInformacoesSplit\")";        
       
        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter categorias. Log: " . $e->getMessage());
            return false;
        }

        $arr = collect($result)->toArray();            

        return $arr;
            
    }

    /**
     * Método pra trazer categorias cadastradas na base Vestylle
     *
     * @return array || false - O resultado da query ou false
     */
    public function getSegmentosPessoa(Pessoa $pessoa)
    {
        $tipoInformacoes = \App\Models\TipoInformacao::pluck('tipo_informacao')->toArray();
        $tipoInformacoesSplit = implode('", "', $tipoInformacoes);

        $query = "SELECT TIPOINFO as descricao, DESCRICAO as conteudo, VALOR as valor
                    FROM vegas_teste.pesinfo WHERE IDPESSOA = $pessoa->id_vestylle 
                    AND TIPOINFO IN (\"$tipoInformacoesSplit\")";
        
        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter categorias. Log: " . $e->getMessage());
            return false;
        }

        $arr = collect($result);            

        return $arr;
            
    }

    /**
     * Metodo para obter o saldo de pontos de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return array || false - O resultado da query ou false.
     */
    public function getSaldoPontosPessoa(Pessoa $pessoa)
    {
        $query = "SELECT SALDO from vegas_teste.fidmovim WHERE DONOID = $pessoa->id_vestylle ORDER BY CNSCADMOM DESC LIMIT 1";

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter saldo de uma pessoa. Log: " . $e->getMessage());
            return false;
        }

        return $result;
    }

    /**
     * Método para obter sexo de uma pessoa - necessária a verificação do array pois a base Vestylle está com diferentes registros
     *
     * @param Pessoa $pessoa
     * @return string||null
     */
    public function getSexo(Pessoa $pessoa)
    {
        $query = "SELECT DESCRICAO as sexo FROM vegas_teste.pesinfo WHERE TIPOINFO = 'SEXO' AND IDPESSOA = $pessoa->id_vestylle";
        $mascArray = ['MASCULINO', 'M', 'masc', 'MASC.'];
        $femArray = ['FEMININO', 'FEM', 'F', 'FEMININA', 'feminio', 'FEMENINO', 'FEMINNO', '(F)', 'FEM.'];

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter saldo de uma pessoa. Log: " . $e->getMessage());
            return false;
        }

        \Log::debug(json_decode($result));
        if (is_array($result)) {
        
            if (in_array($result[0]->{"sexo"}, $mascArray)) {
                return 'Masculino';
            } else if (in_array($result[0]->{"sexo"}, $femArray)) {
                return 'Feminino';
            } else {
                return null;
            }
            
        } else {
            return null;
        }
    }

    /**
     * Metodo para obter a data de vencimento dos pontos de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return array || false - O resultado da query ou false.
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

        return $result;
    }

    /**
     * Metodo para obter a data de nascimento de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return array || false - O resultado da query ou false.
     */
    public function getNascimentoPessoa(Pessoa $pessoa)
    {
        $query = "SELECT NASC FROM vegas_teste.pesdepen WHERE IDPESSOA = $pessoa->id_vestylle AND (TIPO = 'PRINCI' 
        OR TIPO = '') LIMIT 1" ;

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter data de nascimento uma pessoa. Log: " . $e->getMessage());
            return false;
        }

        return $result;
    }


    /**
     * Metodo para obter a data da ultima compra de uma pessoa
     *
     * @param Pessoa $pessoa
     * @return array || false - O resultado da query ou false.
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

        return $result;
    }


    /**
     * Metodo para obter as pessoas novas o BD da Vestylle.
     * Pode ser passado parametros para limitar a query em $valorLimite de dias || horas.
     *
     * @OBS - Esse método nao faz parte do fluxo normal da aplicação, ele é usado somente para testes!
     * @param mixed $tipoLimite - Limite da query [self::LIMITE_DIAS || self::LIMITE_HORAS]
     * @param int $valorLimite - Valor do limite.
     */
    public function getPessoasNovas($tipoLimite=null, $valorLimite=2)
    {
        $query = "SELECT idpessoa, celular, fone, nome, cnpj_cpf, email, cep, cidade, endereco, numero, bairro, complement FROM pessoa WHERE fis_jur = 'F'" ;

        //Se for especificado algum limite de tempo, incluir na query.
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
     * Metodo para obter os IDS das Pessoas que compraram no periodo de tempo
     *
     * @return int || false
     */
    public function getIdsUltimasCompras($tipoLimite=self::LIMITE_DIAS, $valorLimite=2)
    {
        $query = "SELECT pessoa from vegas_teste.cxmovim" ;
        $query .= " WHERE CNSCADMOM > " . str_replace("#", $valorLimite, $tipoLimite);

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter ultimos registros. Log: " . $e->getMessage());
            return false;
        }

        if ($result && count($result)) {
            $arrIds =  collect($result)->pluck('pessoa')->all();            
            
            //Retornando apenas valores nao nulos            
            $values = array_filter(
                $arrIds, function ($value) {
                    return $value ? $value : false;
                }
            );

            return count($values) > 0 ? array_values($values) : [];
        }

        //Se chegou ate aqui, deu ruim :(
        return [];

    }

    /**
     * Metodo para obter os IDS das Pessoas que tiverem saldos atualizados
     *
     * @return int || false
     */
    public function getIdsUltimosSaldos($tipoLimite=self::LIMITE_DIAS, $valorLimite=2)
    {
        $query = "SELECT DONOID from vegas_teste.fidmovim" ;
        $query .= " WHERE CNSCADMOM > " . str_replace("#", $valorLimite, $tipoLimite);

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter ultimos registros. Log: " . $e->getMessage());
            return false;
        }

        if ($result && count($result)) {
            $arrIds =  collect($result)->pluck('DONOID')->all();            
            
            //Retornando apenas valores nao nulos
            $values = array_filter(
                $arrIds, function ($value) {
                    return $value ? $value : false;
                }
            );
            return count($values) > 0 ? array_values($values) : [];
        }

        //Se chegou ate aqui, deu ruim :(
        return [];

    }

    /**
     * Metodo para obter X ultimos CPF's para facilitar o teste
     *
     * @OBS - Esse método nao faz parte do fluxo normal da aplicação, ele é usado somente para testes!
     * @param mixed $tipoLimite - Limite da query [self::LIMITE_DIAS || self::LIMITE_HORAS]
     * @param int $valorLimite - Valor do limite.
     */
    public function getUltimosRegistros($tipoLimite=self::LIMITE_DIAS, $valorLimite=7)
    {
        $query = "SELECT cnpj_cpf  FROM pessoa WHERE fis_jur = 'F' " ;

        //Se for especificado algum limite de tempo, incluir na query.
        if ($tipoLimite) {
            $query .= " AND CNSCADMOM > " . str_replace("#", $valorLimite, $tipoLimite);
        }

        $query .= " ORDER BY CNSCADMOM DESC";

        try {
            $result = $this->query()->select($query);
        } catch (\Exception $e) {
            \Log::error("\n[ERRO] - Erro ao obter ultimos registros. Log: " . $e->getMessage());
            return false;
        }

        return $result;
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
}
