<?php

namespace App\DataTables;

use App\Models\FaleConosco;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class FaleConoscoDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'fale_conoscos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FaleConosco $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FaleConosco $model)
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
                    ['extend' => 'create','text' => '<i class="fa fa-plus"></i> Adicionar'],
                    ['extend' => 'reload','text' => '<i class="fa fa-refresh"></i> Atualizar'],
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
            'id',
            'assunto',
            'contato'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'fale_conoscosdatatable_' . time();
    }
}
