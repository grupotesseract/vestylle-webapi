<?php

use Faker\Factory as Faker;
use App\Models\Cupon;
use App\Repositories\CuponRepository;

trait MakeCuponTrait
{
    /**
     * Create fake instance of Cupon and save it in database
     *
     * @param array $cuponFields
     * @return Cupon
     */
    public function makeCupon($cuponFields = [])
    {
        /** @var CuponRepository $cuponRepo */
        $cuponRepo = App::make(CuponRepository::class);
        $theme = $this->fakeCuponData($cuponFields);
        return $cuponRepo->create($theme);
    }

    /**
     * Get fake instance of Cupon
     *
     * @param array $cuponFields
     * @return Cupon
     */
    public function fakeCupon($cuponFields = [])
    {
        return new Cupon($this->fakeCuponData($cuponFields));
    }

    /**
     * Get fake data of Cupon
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCuponData($cuponFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'data_validade' => $fake->word,
            'texto_cupom' => $fake->text,
            'oferta_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $cuponFields);
    }
}
