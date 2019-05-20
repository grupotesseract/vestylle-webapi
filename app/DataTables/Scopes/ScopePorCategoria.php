<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopePorCategoria implements DataTableScope
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
        return $query->whereHas('categorias', function($qScope) use ($categoriaID) {
            $qScope->where('categoria_id', $categoriaID);
        });
    }
}
