<div class="col-md-6">
    <!-- Id Field -->
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $oferta->id !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('titulo', 'Título da Oferta') !!}
        <p>{!! $oferta->titulo !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('subtitulo', 'Subtítulo da Oferta') !!}
        <p>{!! $oferta->subtitulo !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('preco', 'Preço da oferta') !!}
        <p>{!! 'R$ ' . $oferta->preco !!}</p>
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

</div>
<div class="col-md-6">
    <!-- Foto Oferta Field -->
    <div class="form-group">
        <img src="{{ $oferta->urlFoto }}" width="300" height="300" alt="oferta">
    </div>
</div>
