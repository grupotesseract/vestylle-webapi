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

        <!-- Aparece na listagem Field -->
        <div class="form-group">
            {!! Form::label('id', 'Cupom disponivel em Meus Cupons:') !!}
            <p>{!! $cupon->aparece_listagem ? 'Sim' : 'Não' !!}</p>
        </div>

        <!-- Aparece na homepage Field -->
        <div class="form-group">
            {!! Form::label('id', 'Cupom em destaque na página inicial:') !!}
            <p>{!! $cupon->emDestaque ? 'Sim' : 'Não' !!}</p>
        </div>

        <!-- Código para ativação do cupom -->
        <div class="form-group">
            {!! Form::label('codigo_amigavel', 'Código para ativação do cupom:') !!}
            <p>{!! $cupon->codigo_amigavel !!}</p>
        </div>


        <!-- Data Validade Field -->
        <div class="form-group">
            {!! Form::label('data_validade', 'Data de Validade:') !!}
            <p>{!! $cupon->data_validade->format('d/m/Y') !!}</p>
        </div>

        <!-- Porcentagem OFF Field -->
        <div class="form-group">
            {!! Form::label('porcentagem_off', '% OFF:') !!}
            <p>{!! $cupon->porcentagem_off !!}</p>
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
            <p>{!! $cupon->created_at->format('d/m/Y H:i:s') !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Atualizado Em:') !!}
            <p>{!! $cupon->updated_at->format('d/m/Y H:i:s')  !!}</p>
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

        <!--  Pessoas -->
        <div class="form-group">
            {!! Form::label('pessoas', "Existem $cupon->qntPessoasElegiveis pessoas que podem ver esse cupom") !!}
            -
            <a class="btn btn-xs btn-info" href="{{ route('cupons.pessoas', $cupon->id)}}">
                <i class="fa fa-user"></i> - Ver Detalhes
            </a>
        </div>
        <hr>

        @if ($cupon->fotoDestaque)
            <div class="form-group">
                {!! Form::label('foto_destaque', 'Foto de destaque') !!} <br>
                <img src="{{$cupon->urlFotoDestaque}}" alt="" width=300>
            </div>
        @endif

        @if ($cupon->fotosListagem)
            <div class="form-group">
                {!! Form::label('fotos', 'Fotos da listagem e pagina interna') !!} <br>
                <image-slider :images="{{ $cupon->fotosListagem }}"></image-slider>
            </div>
        @endif

    </div>
</div>
