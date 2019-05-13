<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('titulo', 'Título') !!}
        <p>{!! $cupon->titulo !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('subtitulo', 'Subtítulo') !!}
        <p>{!! $cupon->subtitulo !!}</p>
    </div>

    <!-- Id Field -->
    <div class="form-group">
        {!! Form::label('id', 'Código:') !!}
        <p>{!! $cupon->id !!}</p>
    </div>

    <!-- Data Validade Field -->
    <div class="form-group">
        {!! Form::label('data_validade', 'Data de validade:') !!}
        <p>{!! $cupon->data_validade !!}</p>
    </div>

    <!-- Texto Cupom Field -->
    <div class="form-group">
        {!! Form::label('texto_cupom', 'Texto do cupom:') !!}
        <p>{!! $cupon->texto_cupom !!}</p>
    </div>

    <!-- Oferta Id Field -->
    <div class="form-group">
        {!! Form::label('oferta_id', 'Código da oferta:') !!}
        <p>{!! $cupon->oferta_id !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Criado em:') !!}
        <p>{!! $cupon->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Atualizado em:') !!}
        <p>{!! $cupon->updated_at !!}</p>
    </div>
</div>

@if ($cupon->fotos)
<div class="row">
    <div class="col-md-6">
        <image-slider :images="{{ $cupon->fotos }}"></image-slider>
    </div>
</div>
@endif
