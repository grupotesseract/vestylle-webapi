<?php

namespace App\Repositories;

use App\Models\Cupon;
use InfyOm\Generator\Common\BaseRepository;
use Exception;

/**
 * Class CuponRepository
 * @package App\Repositories
 * @version March 17, 2019, 9:59 pm UTC
 *
 * @method Cupon findWithoutFail($id, $columns = ['*'])
 * @method Cupon find($id, $columns = ['*'])
 * @method Cupon first($columns = ['*'])
*/
class CuponRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_validade',
        'texto_cupom',
        'oferta_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cupon::class;
    }

    /**
     * Retorna o cupon referente ao idEncryptado sem falhar caso nao exista
     *
     * @param mixed $id
     * @param string $columns
     */
    public function findEncryptadoWithoutFail($id, $columns = ['*'])
    {
        try {
            return $this->model()::findEncryptado($id, $columns);
        } catch (Exception $e) {
            return;
        }
    }
}
