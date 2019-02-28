<?php

use Faker\Factory as Faker;
use App\Models\Pessoa;
use App\Repositories\PessoaRepository;

trait MakePessoaTrait
{
    /**
     * Create fake instance of Pessoa and save it in database
     *
     * @param array $pessoaFields
     * @return Pessoa
     */
    public function makePessoa($pessoaFields = [])
    {
        /** @var PessoaRepository $pessoaRepo */
        $pessoaRepo = App::make(PessoaRepository::class);
        $theme = $this->fakePessoaData($pessoaFields);
        return $pessoaRepo->create($theme);
    }

    /**
     * Get fake instance of Pessoa
     *
     * @param array $pessoaFields
     * @return Pessoa
     */
    public function fakePessoa($pessoaFields = [])
    {
        return new Pessoa($this->fakePessoaData($pessoaFields));
    }

    /**
     * Get fake data of Pessoa
     *
     * @param array $postFields
     * @return array
     */
    public function fakePessoaData($pessoaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id_vestylle' => $fake->randomDigitNotNull,
            'saldo_pontos' => $fake->word,
            'celular' => $fake->word,
            'telefone_fixo' => $fake->word,
            'email' => $fake->word,
            'email_verified_at' => $fake->date('Y-m-d H:i:s'),
            'password' => $fake->word,
            'remember_token' => $fake->word,
            'nome' => $fake->word,
            'cpf' => $fake->word,
            'cep' => $fake->word,
            'endereco' => $fake->word,
            'numero' => $fake->word,
            'bairro' => $fake->word,
            'complemento' => $fake->word,
            'data_ultima_compra' => $fake->date('Y-m-d H:i:s'),
            'data_nascimento' => $fake->date('Y-m-d H:i:s'),
            'cidade_id' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $pessoaFields);
    }
}
