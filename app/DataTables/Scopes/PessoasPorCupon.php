<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

/**
 * Class: PessoasPorCupon
 *
 * Classe para filtrar as pessoas que adicionaram determinado cupom a sua lista de desejos
 *
 * @see DataTableScope
 */
class PessoasPorCupon implements DataTableScope
{

    private $cuponID;

    /**
     * @param mixed $cuponID
     */
    public function __construct($cuponID)
    {
        $this->cuponID = $cuponID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $cuponID = $this->cuponID;
        return $query->whereHas('cupons', function($qCupom) use ($cuponID) {
            $qCupom->where('cupom_id', $cuponID);
        });
    }
}
