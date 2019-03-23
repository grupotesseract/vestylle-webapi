<!-- Descricao Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descricao_oferta', 'Descrição da oferta') !!}
    {!! Form::text('descricao_oferta', null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto_oferta', 'Texto da oferta') !!}
    {!! Form::text('texto_oferta', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto_oferta', 'Foto da oferta') !!}
    {!! Form::file('foto_oferta', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ofertas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
