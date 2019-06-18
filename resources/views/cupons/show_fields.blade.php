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

        <!-- Aparece na listagem Field -->
        <div class="form-group">
            {!! Form::label('id', 'Aparece na Listagem:') !!}
            <p>{!! $cupon->aparece_listagem ? 'Sim' : 'Não' !!}</p>
        </div>

        <!-- Aparece na homepage Field -->
        <div class="form-group">
            {!! Form::label('id', 'Cupom em destaque:') !!}
            <p>{!! $cupon->emDestaque ? 'Sim' : 'Não' !!}</p>
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
