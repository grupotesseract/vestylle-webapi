<!-- Data Validade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_validade', 'Valido até') !!}
    {!! Form::date('data_validade', $cupon->data_validade ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Cupom Primeiro Login Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cupom_primeiro_login', 'Adicionar ao usuário no primeiro login') !!}
    {!! Form::checkbox('cupom_primeiro_login', null, ['class' => 'form-control', 'value' => $cupon->cupom_primeiro_login ?? false]) !!}
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
