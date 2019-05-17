<?php

namespace App\Repositories;

use App\Models\TipoInformacao;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoInformacaoRepository
 * @package App\Repositories
 * @version May 17, 2019, 9:37 pm UTC
 *
 * @method TipoInformacao findWithoutFail($id, $columns = ['*'])
 * @method TipoInformacao find($id, $columns = ['*'])
 * @method TipoInformacao first($columns = ['*'])
*/
class TipoInformacaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_informacao'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoInformacao::class;
    }
}
