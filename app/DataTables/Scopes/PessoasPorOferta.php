<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PessoasPorOferta implements DataTableScope
{

    private $ofertaID;

    /**
     * @param mixed $ofertaID
     */
    public function __construct($ofertaID)
    {
        $this->ofertaID = $ofertaID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $ofertaID = $this->ofertaID;
        return $query->whereHas('listaDesejos', function($qPessoa) use ($ofertaID) {
            $qPessoa->where('oferta_id', $ofertaID);
        });
    }
}
