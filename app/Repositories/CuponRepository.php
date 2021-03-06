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
    public function findEncryptadoWithoutFail($idEncryptado)
    {
        try {
            return $this->model()::findEncryptado($idEncryptado);
        } catch (Exception $e) {
            return;
        }
    }

    /**
     * Retorna o cupon referente ao codigo amigavel sem falhar caso nao exista
     *
     * @param mixed $id
     * @param string $columns
     */
    public function findByCodigoAmigavel($codigoAmigavel)
    {
        try {
            return $this->model()::findByCodigoAmigavel($codigoAmigavel);
        } catch (Exception $e) {
            return;
        }
    }

    /**
     * Get Cupons que tem 'aparece_listagem' marcado como true
     * Mescla cupons segmentados pra uma pessoa, e cupons sem segmentos
     *
     * @return Collection
     */
    public function apareceListagem($pessoa)
    {
        $cuponsNaoSegmentados = $this->model()::with('fotos')->apareceListagem()
            ->NaoVencidos()
            ->NaoSegmentados()
            ->get();

        //Se pessoa: devemos considerar segmentacao e excluir cupons 'ja utilizados no caixa'
        if (!is_null($pessoa)) {

            $cuponsSegmentados = $this->model()::with('fotos')->apareceListagem()
                ->NaoVencidos()
                ->SegmentadosPorUsuario($pessoa)
                ->get();

            //Cupons marcados como utilizados no caixa por essa pessoa
            $cuponsUtilizadosVenda = $this->model()::with('fotos')->apareceListagem()
                ->UtilizadoVenda($pessoa)
                ->get();
            
            $cuponsExpirados = $this->model()::Expirados($pessoa)->get();

            //Mergeando Cupons, assim nao ficam duplicados e existem de ambos grupos
            $cupons = $cuponsSegmentados->merge($cuponsNaoSegmentados);
            //Excluindo cupons ja utilizados apos o merge
            $cupons = $cupons->diff($cuponsUtilizadosVenda);
            $cupons = $cupons->diff($cuponsExpirados);


        } else {
            $cupons = $cuponsNaoSegmentados;
        }

        return $cupons;
    }

}
