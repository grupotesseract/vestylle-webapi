<?php

namespace App\Repositories;

use App\Models\FaleConosco;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FaleConoscoRepository
 * @package App\Repositories
 * @version March 21, 2019, 12:20 am UTC
 *
 * @method FaleConosco findWithoutFail($id, $columns = ['*'])
 * @method FaleConosco find($id, $columns = ['*'])
 * @method FaleConosco first($columns = ['*'])
*/
class FaleConoscoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'assunto',
        'mensagem',
        'contato'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FaleConosco::class;
    }
}
