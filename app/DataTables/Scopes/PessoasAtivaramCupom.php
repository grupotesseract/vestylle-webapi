<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

/**
 * Class: PessoasAtivaramCupom
 *
 * Classe para filtrar as pessoas que ativaram um cupom e não foram marcados como utilizado no caixa
 *
 * @see DataTableScope
 */
class PessoasAtivaramCupom implements DataTableScope
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
            $qCupom->where('cupom_id', $cuponID)
               ->where('cupom_utilizado_venda', false);
        });
    }
}
