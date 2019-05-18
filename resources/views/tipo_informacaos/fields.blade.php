<!-- Tipo Informacao Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_informacao', 'Tipo Informacao:') !!}
    {!! Form::text('tipo_informacao', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoInformacaos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
