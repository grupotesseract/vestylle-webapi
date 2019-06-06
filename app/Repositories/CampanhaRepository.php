<?php

namespace App\Repositories;

use App\Models\Campanha;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CampanhaRepository
 * @package App\Repositories
 * @version June 6, 2019, 10:11 pm UTC
 *
 * @method Campanha findWithoutFail($id, $columns = ['*'])
 * @method Campanha find($id, $columns = ['*'])
 * @method Campanha first($columns = ['*'])
*/
class CampanhaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Campanha::class;
    }
}
