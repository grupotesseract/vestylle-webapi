<?php

namespace App\Http\Controllers;

use Response;
use App\Jobs\RemoverImagem;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class FotoAPIController extends AppBaseController
{
    /**
     * Remove a imagem do banco e invoca um job para excluir do Cloudinary
     *
     * @return void
     */
    public function remover($imagem_id)
    {
        $this->dispatch(new RemoverImagem($imagem_id));
        return Response::json('Imagem removida com sucesso', 200);
    }

}
