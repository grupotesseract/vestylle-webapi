<div class="row">
    <div class="col-md-4">
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

        <!-- Porcentagem OFF Field -->
        <div class="form-group">
            {!! Form::label('porcentagem_off', '% OFF:') !!}
            <p>{!! $oferta->porcentagem_off !!}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Criada em:') !!}
            <p>{!! $oferta->created_at->format('d/m/Y H:i:s') !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Atualizada em:') !!}
            <p>{!! $oferta->updated_at->format('d/m/Y H:i:s')  !!}</p>
        </div>

        @if ($oferta->categorias()->count())
            <div class="form-group">
                {!! Form::label('categorias', 'Categorias:') !!}
                <ul>
                    @foreach ($oferta->categorias as $categoria)
                        <li>{{ $categoria->nome }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <div class="col-md-8">
        @if ($oferta->fotos()->count())
            <div class="form-group">
                {!! Form::label('fotos', 'Fotos:') !!}
                <image-slider :images="{{ $oferta->fotos }}"></image-slider>
            </div>
        @endif

    </div>
</div>
