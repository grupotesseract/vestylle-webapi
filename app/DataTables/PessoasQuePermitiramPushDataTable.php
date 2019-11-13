<?php

namespace App\DataTables;

use App\Models\Pessoa;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PessoasQuePermitiramPushDataTable extends DataTable
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
            $mostrarBtnBaixaCaixa = false;
            return view('pessoas.datatables_actions', compact('id', 'mostrarBtnBaixaCaixa'))
                ->render();
        })->addColumn('notificacoes', function ($model) {
            return $model->permitePushs ? 'Sim' : 'Não';
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
        $idsPessoasExpo = \DB::table(Pessoa::TABELA_PERMISSOES_EXPO_PUSH)
            ->get()->pluck('key')
            ->map(function($value) {
                preg_match("#\.(\d+)#", $value, $output);
                return (int) $output[1];
            });

        $idsPessoasWeb = Pessoa::has('permissoesWebPush')->pluck('id');
        $idsPessoasNotificacoes = $idsPessoasExpo->merge($idsPessoasWeb)->unique();

        return $model->whereIn('id', $idsPessoasNotificacoes);
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
                    [ 'extend' => 'colvis', 'text'    => '<i class="fa fa-filter"></i> Filtrar Colunas', ]
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
            'id' => ['visible' => false],
            'id_vestylle' => ['visible' => false],
            'cpf',
            'nome',
            'notificacoes' => [
                'data'=>'notificacoes',
                'title'=>'Permitiu Notificações',
                'filterable'=> false,
                'searchable'=> false,
                'orderable' => false,
                'visible' => false
            ],

            'saldo_pontos' => ['visible' => false],
            'celular',
            //'telefone_fixo',
            'email',
            'data_nascimento' => ['visible' => false],
            // 'email_verified_at',
            // 'cep',
            // 'endereco',
            // 'numero',
            // 'bairro',
            // 'complemento',
            //'data_ultima_compra',
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
