<?php

namespace App\DataTables;

use App\Models\Loja;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LojaDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'lojas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Loja $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Loja $model)
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
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'text' => '<i class="fa fa-plus"></i> Adicionar'],
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> Exportar'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> Imprimir'],
                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Atualizar'],
                    [
                        'extend' => 'colvis',
                        'text'    => 'Filtrar Colunas',
                    ]
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
            'nome'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'lojasdatatable_' . time();
    }
}
