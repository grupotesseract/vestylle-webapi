<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $oferta->id !!}</p>
</div>

<!-- Descricao Oferta Field -->
<div class="form-group">
    {!! Form::label('descricao_oferta', 'Descrição da Oferta') !!}
    <p>{!! $oferta->descricao_oferta !!}</p>
</div>

<!-- Texto Oferta Field -->
<div class="form-group">
    {!! Form::label('texto_oferta', 'Texto da Oferta') !!}
    <p>{!! $oferta->texto_oferta !!}</p>
</div>

<!-- Foto Oferta Field -->
<div class="form-group">
    {!! Form::label('foto_oferta', 'Foto da oferta:') !!}
    <img src="{!! url('storage/' . $oferta->foto_oferta) !!}" alt="oferta">
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criada em:') !!}
    <p>{!! $oferta->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizada em:') !!}
    <p>{!! $oferta->updated_at !!}</p>
</div>

