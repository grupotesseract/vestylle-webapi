<div class="row">
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
            {!! Form::label('created_at', 'Criada Em:') !!}
            <p>{!! $oferta->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Atualizada Em:') !!}
            <p>{!! $oferta->updated_at !!}</p>
        </div>

    </div>

    <div class="col-md-6">
        @if ($oferta->fotos()->count())
            <div class="form-group">
                {!! Form::label('fotos', 'Fotos:') !!}
                <image-slider :images="{{ $oferta->fotos }}"></image-slider>
            </div>
        @endif

        @if ($oferta->categorias()->count())
            <div class="form-group">
                {!! Form::label('categorias', 'Categorias:') !!}
                <ul style="margin-left:.5rem">
                    @foreach ($oferta->categorias as $categoria)
                        <li>{{ $categoria->nome }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
