<?php

namespace App\Helpers;

class Helpers
{
    public function __construct()
    {

    }

    /**
     * Retorna false se o model for passar de 10 fotos
     *
     * @return boolean
     */
    public static function checkUploadLimit($model, $upload_count)
    {
        $model_fotos_count = $model->fotos()->count();

        return $model_fotos_count + $upload_count <= 10;
    }
}
