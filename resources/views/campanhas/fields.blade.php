<!-- Titulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Titulo:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('texto', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Ultima Compra Menor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_ultima_compra_menor', 'Data Ultima Compra Menor:') !!}
    {!! Form::date('data_ultima_compra_menor', null, ['class' => 'form-control','id'=>'data_ultima_compra_menor']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#data_ultima_compra_menor').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Data Ultima Compra Maior Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_ultima_compra_maior', 'Data Ultima Compra Maior:') !!}
    {!! Form::date('data_ultima_compra_maior', null, ['class' => 'form-control','id'=>'data_ultima_compra_maior']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#data_ultima_compra_maior').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Data Vencimento Pontos Menor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_vencimento_pontos_menor', 'Data Vencimento Pontos Menor:') !!}
    {!! Form::date('data_vencimento_pontos_menor', null, ['class' => 'form-control','id'=>'data_vencimento_pontos_menor']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#data_vencimento_pontos_menor').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Data Vencimento Pontos Maior Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_vencimento_pontos_maior', 'Data Vencimento Pontos Maior:') !!}
    {!! Form::date('data_vencimento_pontos_maior', null, ['class' => 'form-control','id'=>'data_vencimento_pontos_maior']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#data_vencimento_pontos_maior').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Ano Nascimento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ano_nascimento', 'Ano Nascimento:') !!}
    {!! Form::date('ano_nascimento', null, ['class' => 'form-control','id'=>'ano_nascimento']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#ano_nascimento').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Condicao Ano Nascimento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condicao_ano_nascimento', 'Condicao Ano Nascimento:') !!}
    {!! Form::text('condicao_ano_nascimento', null, ['class' => 'form-control']) !!}
</div>

<!-- Mes Aniversario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mes_aniversario', 'Mes Aniversario:') !!}
    {!! Form::date('mes_aniversario', null, ['class' => 'form-control','id'=>'mes_aniversario']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#mes_aniversario').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Condicao Mes Aniversario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condicao_mes_aniversario', 'Condicao Mes Aniversario:') !!}
    {!! Form::text('condicao_mes_aniversario', null, ['class' => 'form-control']) !!}
</div>

<!-- Saldo Pontos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('saldo_pontos', 'Saldo Pontos:') !!}
    {!! Form::date('saldo_pontos', null, ['class' => 'form-control','id'=>'saldo_pontos']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#saldo_pontos').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Condicao Saldo Pontos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condicao_saldo_pontos', 'Condicao Saldo Pontos:') !!}
    {!! Form::text('condicao_saldo_pontos', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campanhas.index') !!}" class="btn btn-default">Cancel</a>
</div>
