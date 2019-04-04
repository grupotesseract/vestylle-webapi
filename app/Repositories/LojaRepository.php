<?php

namespace App\Repositories;

use App\Models\Loja;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LojaRepository
 * @package App\Repositories
 * @version April 3, 2019, 11:35 pm UTC
 *
 * @method Loja findWithoutFail($id, $columns = ['*'])
 * @method Loja find($id, $columns = ['*'])
 * @method Loja first($columns = ['*'])
*/
class LojaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Loja::class;
    }
}
