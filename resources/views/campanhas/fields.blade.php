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

<!-- Data Nascimento Menor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_nascimento_menor', 'Data Nascimento Menor:') !!}
    {!! Form::date('data_nascimento_menor', null, ['class' => 'form-control','id'=>'data_nascimento_menor']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#data_nascimento_menor').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Data Nascimento Maior Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_nascimento_maior', 'Data Nascimento Maior:') !!}
    {!! Form::date('data_nascimento_maior', null, ['class' => 'form-control','id'=>'data_nascimento_maior']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#data_nascimento_maior').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campanhas.index') !!}" class="btn btn-default">Cancel</a>
</div>
