<!-- Data Validade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_validade', 'Valido até') !!}
    {!! Form::date('data_validade', null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Cupom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto_cupom', 'Texto') !!}
    {!! Form::text('texto_cupom', null, ['class' => 'form-control']) !!}
</div>

<!-- Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('oferta_id', 'Descrição da Oferta:') !!}
    {!! Form::select('oferta_id', $ofertas->pluck('descricao_oferta', 'id')->unique(), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Cancelar</a>
</div>
