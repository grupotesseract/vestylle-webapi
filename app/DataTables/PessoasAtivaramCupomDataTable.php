<?php

namespace App\DataTables;

use App\Models\Pessoa;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PessoasAtivaramCupomDataTable extends DataTable
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

        return $dataTable->addColumn('action', function ($cupon) {
            $id = $cupon->id;
            $mostrarBtnBaixaCaixa = true;
            return view('pessoas.datatables_actions', compact('id', 'mostrarBtnBaixaCaixa'))
                ->render();
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pessoa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pessoa $model)
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
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> Exportar'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> Imprimir'],
                    ['extend' => 'reload','text' => '<i class="fa fa-refresh"></i> Atualizar'],
                    [
                        'extend' => 'colvis',
                        'text'    => 'Filtrar Colunas',
                    ]
                ],
                'language' => ['url' => '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'],
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
            // 'id_vestylle',
            'saldo_pontos',
            'celular',
            'telefone_fixo',
            'email',
            // 'email_verified_at',
            'nome',
            // 'cpf',
            // 'cep',
            // 'endereco',
            // 'numero',
            // 'bairro',
            // 'complemento',
            'data_ultima_compra',
            'data_nascimento',
            // 'cidade_id'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pessoasdatatable_' . time();
    }
}
