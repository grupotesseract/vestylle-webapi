<?php

namespace App\DataTables;

use App\Models\Categoria;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoriaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', 'categorias.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Categoria $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Categoria $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'title' => 'Ações'])
            ->parameters([
                'dom'     => 'Brtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> Exportar'],
                ],
                'language' => [
                    'url' => url('//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json')
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'nome', 'title' => 'Nome', 'orderable'=>false, 'filterable'=>false, 'searchable'=>false],
            ['data' => 'numPessoas', 'title' => 'Nº Pessoas', 'orderable'=>false, 'filterable'=>false, 'searchable'=>false],
            ['data' => 'numOfertas', 'title' => 'Nº Ofertas', 'orderable'=>false, 'filterable'=>false, 'searchable'=>false],
            ['data' => 'numCupons', 'title' => 'Nº Cupons', 'orderable'=>false, 'filterable'=>false, 'searchable'=>false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categoriasdatatable_' . time();
    }
}
