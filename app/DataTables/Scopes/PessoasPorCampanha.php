<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;
use App\Models\Campanha;

class PessoasPorCampanha implements DataTableScope
{

    private $campanhaID;

    /**
     * @param mixed $campanhaID
     */
    public function __construct($campanhaID)
    {
        $this->campanhaID = $campanhaID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $campanha = Campanha::find($this->campanhaID);
        $ids = $campanha->pessoasQuery->pluck('id');
        return $query->whereIn('id', $ids);
    }
}
