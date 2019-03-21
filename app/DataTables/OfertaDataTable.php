<?php

namespace App\DataTables;

use App\Models\Oferta;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OfertaDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'ofertas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Oferta $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Oferta $model)
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
            ->addAction(['width' => '120px'])
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
        $url = url('storage/');
        return [
            ['data' => 'descricao_oferta', 'title' => 'Descrição'],
            'foto_oferta' => [
                'name' => 'foto_oferta',
                'data' => 'foto_oferta',
                'title' => 'Foto',
                'render' => "`<img src=\"$url/` + data + `\" height=\"50\"/>`"
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ofertasdatatable_' . time();
    }
}
