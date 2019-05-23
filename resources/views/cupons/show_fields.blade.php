<div class="row">
    <div class="col-md-4">
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
            {!! Form::label('data_validade', 'Data de Validade:') !!}
            <p>{!! $cupon->data_validade !!}</p>
        </div>

        <!-- Texto Cupom Field -->
        <div class="form-group">
            {!! Form::label('texto_cupom', 'Texto do Cupom:') !!}
            <p>{!! $cupon->texto_cupom !!}</p>
        </div>

        <!-- Oferta Id Field -->
        <div class="form-group">
            {!! Form::label('oferta_id', 'Código da Oferta:') !!}
            <p>{!! $cupon->oferta_id !!}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Criado Em:') !!}
            <p>{!! $cupon->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Atualizado Em:') !!}
            <p>{!! $cupon->updated_at !!}</p>
        </div>

        @if ($cupon->categorias()->count())
            <div class="form-group">
                {!! Form::label('categorias', 'Categorias:') !!}
                <ul>
                    @foreach ($cupon->categorias as $categoria)
                        <li>{{ $categoria->nome }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-md-8">
        @if ($cupon->fotos)
            <div class="form-group">
                <image-slider :images="{{ $cupon->fotos }}"></image-slider>
            </div>
        @endif

    </div>
</div>
