<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

/**
 * Class: PessoasPorNCategorias
 *
 * Filtra as pessoas com base em um array de ids de categorias
 *
 * @see DataTableScope
 */
class PessoasPorNCategorias implements DataTableScope
{

    private $idsCategorias;

    /**
     * @param mixed $categoriaID
     */
    public function __construct($idsCategorias)
    {
        $this->idsCategorias = $idsCategorias;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $idsCategorias = $this->idsCategorias;
        return $query->whereHas('categorias', function($qScope) use ($idsCategorias) {
            $qScope->whereIn('categoria_id', $idsCategorias);
        });
    }
}
