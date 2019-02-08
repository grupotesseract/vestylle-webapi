<?php

namespace App\Helpers;

/**
 * Class VestylleDBHelper - Classe para centralizar a intermediação com o DB da vestylle;
 */
class VestylleDBHelper
{

    private $connection;

    /**
     * @param mixed $dependencies
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
     * Metodo para obter os registros das Pessoas a partir do banco da vestylle e criar no banco da aplicação
     *
     * @return void
     */
    public function createPessoas()
    {
        $query = "SELECT idpessoa, celular, fone, nome, cnpj_cpf, email, cep, cidade, endereco, numero, bairro, complement FROM pessoa WHERE fis_jur = 'F'" ;
        $result = $this->query()->select($query);

        //Iterando, atrelando a cidade no BD (qnd existir) e salvando
        foreach ($result as $pessoa) {

            $Cidade = \Cidade::where('nome_sanitized', $this->sanitizeString($pessoa->cidade))->first();
            $cidadeId = $Cidade ? $Cidade->id : null;

            \Pessoa::create([
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

        return count($result);
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
     * Metodo para remover acentos / caracteres especiais e retornar a string lowercase
     *
     * @param mixed $str
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


