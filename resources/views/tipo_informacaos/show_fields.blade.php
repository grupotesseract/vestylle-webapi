<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $tipoInformacao->id !!}</p>
</div>

<!-- Tipo Informacao Field -->
<div class="form-group">
    {!! Form::label('tipo_informacao', 'Tipo Informacao:') !!}
    <p>{!! $tipoInformacao->tipo_informacao !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $tipoInformacao->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $tipoInformacao->updated_at !!}</p>
</div>

