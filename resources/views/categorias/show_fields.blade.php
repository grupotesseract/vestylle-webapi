<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $categoria->id !!}</p>
</div>

<!-- Descricao Field -->
<div class="form-group">
    {!! Form::label('descricao', 'Descricao:') !!}
    <p>{!! $categoria->descricao !!}</p>
</div>

<!-- Conteudo Field -->
<div class="form-group">
    {!! Form::label('conteudo', 'Conteudo:') !!}
    <p>{!! $categoria->conteudo !!}</p>
</div>

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $categoria->valor !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $categoria->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $categoria->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $categoria->deleted_at !!}</p>
</div>

