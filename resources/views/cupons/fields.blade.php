<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Título') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('subtitulo', 'Subtítulo') !!}
    {!! Form::text('subtitulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Validade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_validade', 'Valido até') !!}
    {!! Form::date('data_validade', $cupon->data_validade ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Cupom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto_cupom', 'Texto') !!}
    {!! Form::text('texto_cupom', null, ['class' => 'form-control']) !!}
</div>

@empty($cupon->oferta_id)
    <!-- Foto Caminho Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('foto_caminho', 'Foto do Cupom:') !!}
        {!! Form::file('foto_caminho', null, ['class' => 'form-control']) !!}
    </div>
@endempty

<!-- Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('oferta_id', 'Descrição da Oferta:') !!}
    {!! Form::select('oferta_id', $ofertas->pluck('descricao_oferta', 'id')->unique(), ['class' => 'form-control'], ['placeholder' => 'Escolha uma Oferta']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Cancelar</a>
</div>
