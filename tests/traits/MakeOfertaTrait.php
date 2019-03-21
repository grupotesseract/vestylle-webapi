<?php

use Faker\Factory as Faker;
use App\Models\Oferta;
use App\Repositories\OfertaRepository;

trait MakeOfertaTrait
{
    /**
     * Create fake instance of Oferta and save it in database
     *
     * @param array $ofertaFields
     * @return Oferta
     */
    public function makeOferta($ofertaFields = [])
    {
        /** @var OfertaRepository $ofertaRepo */
        $ofertaRepo = App::make(OfertaRepository::class);
        $theme = $this->fakeOfertaData($ofertaFields);
        return $ofertaRepo->create($theme);
    }

    /**
     * Get fake instance of Oferta
     *
     * @param array $ofertaFields
     * @return Oferta
     */
    public function fakeOferta($ofertaFields = [])
    {
        return new Oferta($this->fakeOfertaData($ofertaFields));
    }

    /**
     * Get fake data of Oferta
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOfertaData($ofertaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'descricao_oferta' => $fake->text,
            'foto_oferta' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $ofertaFields);
    }
}
