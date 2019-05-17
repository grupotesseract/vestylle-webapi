<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PessoasPorCategoria implements DataTableScope
{

    private $categoriaID;

    /**
     * @param mixed $categoriaID
     */
    public function __construct($categoriaID)
    {
        $this->categoriaID = $categoriaID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $categoriaID = $this->categoriaID;
        return $query->whereHas('categorias', function($qPessoa) use ($categoriaID) {
            $qPessoa->where('categoria_id', $categoriaID);
        });
    }
}
