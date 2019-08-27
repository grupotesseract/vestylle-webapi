<div class="row">
    <div class="col-md-4">
        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $oferta->id !!}</p>
        </div>

        <div class="form-group">
            {!! Form::label('titulo', 'Título do Produto') !!}
            <p>{!! $oferta->titulo !!}</p>
        </div>

        <div class="form-group">
            {!! Form::label('subtitulo', 'Subtítulo do Produto') !!}
            <p>{!! $oferta->subtitulo !!}</p>
        </div>

        <!-- Descricao Oferta Field -->
        <div class="form-group">
            {!! Form::label('descricao_oferta', 'Descrição do Produto') !!}
            <p>{!! $oferta->descricao_oferta !!}</p>
        </div>

        <!-- Texto Oferta Field -->
        <div class="form-group">
            {!! Form::label('texto_oferta', 'Texto do Produto') !!}
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
        <!--  Pessoas -->
        <div class="form-group">
            {!! Form::label('pessoas', "Existem $oferta->qntPessoasElegiveis pessoas que podem ver esse cupom") !!}
            -
            <a class="btn btn-xs btn-info" href="{{ route('ofertas.pessoas', $oferta->id)}}">
                <i class="fa fa-user"></i> - Ver Detalhes
            </a>
        </div>
        <hr>
        @if ($oferta->fotos()->count())
            <div class="form-group">
                {!! Form::label('fotos', 'Fotos:') !!}
                <image-slider :images="{{ $oferta->fotos }}"></image-slider>
            </div>
        @endif

    </div>
</div>
