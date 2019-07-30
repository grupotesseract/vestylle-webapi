<div class="row">
    <div class="col-sm-4">
        <!-- Endereco Field -->
        <div class="form-group">
            {!! Form::label('endereco', 'Endereço:') !!}
            <p>{!! $loja->endereco !!}</p>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            <p>{!! $loja->email !!}</p>
        </div>

        <!-- Whatsapp Field -->
        <div class="form-group">
            {!! Form::label('whatsapp', 'Whatsapp:') !!}
            <p>{!! $loja->whatsapp !!}</p>
        </div>

        <!-- Whatsapp 2 Field -->
        <div class="form-group">
            {!! Form::label('whatsapp2', 'Whatsapp:') !!}
            <p>{!! $loja->whatsapp2 !!}</p>
        </div>

        <!-- Telefone Field -->
        <div class="form-group">
            {!! Form::label('telefone', 'Telefone:') !!}
            <p>{!! $loja->telefone !!}</p>
        </div>

    </div>
    <div class="col-sm-8 conteudo-centralizado">

        @if ($loja->fotos)
            <image-slider :images="{{ $loja->fotos }}"></image-slider>
        @endif

    </div>
</div>
