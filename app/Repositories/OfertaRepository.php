<?php

namespace App\Repositories;

use App\Models\Oferta;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OfertaRepository
 * @package App\Repositories
 * @version March 17, 2019, 7:58 pm UTC
 *
 * @method Oferta findWithoutFail($id, $columns = ['*'])
 * @method Oferta find($id, $columns = ['*'])
 * @method Oferta first($columns = ['*'])
*/
class OfertaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descricao_oferta',
        'foto_oferta'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Oferta::class;
    }

    /**
     * Get Ofertas 
     * Mescla ofertas segmentados pra uma pessoa, e ofertas sem segmentos
     *
     * @return Collection
     */
    public function apareceListagem($pessoa)
    {
        if (!is_null($pessoa)) {
            $ofertasSegmentados = $this->model()::with(['cupons', 'fotos'])
                ->SegmentadosPorUsuario($pessoa)->get();
        }

        $ofertasNaoSegmentados = $this->model()::with(['cupons', 'fotos'])
            ->NaoSegmentados()->get();
        
        $ofertas = $ofertasSegmentados->merge($ofertasNaoSegmentados);
        
        return $ofertas;
    }
}
