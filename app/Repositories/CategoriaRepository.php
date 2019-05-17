<?php

namespace App\Repositories;

use App\Models\Categoria;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoriaRepository
 * @package App\Repositories
 * @version April 3, 2019, 11:35 pm UTC
 *
 * @method Categoria findWithoutFail($id, $columns = ['*'])
 * @method Categoria find($id, $columns = ['*'])
 * @method Categoria first($columns = ['*'])
*/
class CategoriaRepository extends BaseRepository
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
        return Categoria::class;
    }

    /**
     * Metodo para obter o array de categorias possiveis para adicionar a um cupon/oferta
     *
     * @OBS: Checar se esse o unique nao pode acabar deixando pessoas de fora sendo que agrupa os 'ids'
     *
     * @return Collection
     */
    public static function getCategoriasSelect()
    {
        return Categoria::all()->pluck('nome', 'id')->unique();
    }



}
