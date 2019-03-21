<?php

use Faker\Factory as Faker;
use App\Models\FaleConosco;
use App\Repositories\FaleConoscoRepository;

trait MakeFaleConoscoTrait
{
    /**
     * Create fake instance of FaleConosco and save it in database
     *
     * @param array $faleConoscoFields
     * @return FaleConosco
     */
    public function makeFaleConosco($faleConoscoFields = [])
    {
        /** @var FaleConoscoRepository $faleConoscoRepo */
        $faleConoscoRepo = App::make(FaleConoscoRepository::class);
        $theme = $this->fakeFaleConoscoData($faleConoscoFields);
        return $faleConoscoRepo->create($theme);
    }

    /**
     * Get fake instance of FaleConosco
     *
     * @param array $faleConoscoFields
     * @return FaleConosco
     */
    public function fakeFaleConosco($faleConoscoFields = [])
    {
        return new FaleConosco($this->fakeFaleConoscoData($faleConoscoFields));
    }

    /**
     * Get fake data of FaleConosco
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFaleConoscoData($faleConoscoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'pessoa_id' => $fake->randomDigitNotNull,
            'assunto' => $fake->word,
            'mensagem' => $fake->word,
            'contato' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $faleConoscoFields);
    }
}
