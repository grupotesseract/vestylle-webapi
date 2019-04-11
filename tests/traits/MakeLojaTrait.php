<?php

use Faker\Factory as Faker;
use App\Models\Loja;
use App\Repositories\LojaRepository;

trait MakeLojaTrait
{
    /**
     * Create fake instance of Loja and save it in database
     *
     * @param array $lojaFields
     * @return Loja
     */
    public function makeLoja($lojaFields = [])
    {
        /** @var LojaRepository $lojaRepo */
        $lojaRepo = App::make(LojaRepository::class);
        $theme = $this->fakeLojaData($lojaFields);
        return $lojaRepo->create($theme);
    }

    /**
     * Get fake instance of Loja
     *
     * @param array $lojaFields
     * @return Loja
     */
    public function fakeLoja($lojaFields = [])
    {
        return new Loja($this->fakeLojaData($lojaFields));
    }

    /**
     * Get fake data of Loja
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLojaData($lojaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'cor_primaria' => $fake->word,
            'cor_secundaria' => $fake->word,
            'cor_terciaria' => $fake->word,
            'endereco' => $fake->word,
            'email' => $fake->word,
            'whatsapp' => $fake->word,
            'telefone' => $fake->word,
            'horario_funcionamento' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $lojaFields);
    }
}
