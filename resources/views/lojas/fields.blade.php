<!-- Endereco Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endereco', 'Endereço:') !!}
    {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Whatsapp Field -->
<div class="form-group col-sm-4">
    {!! Form::label('whatsapp', '1º Whatsapp:') !!}
    {!! Form::text('whatsapp', null, ['class' => 'form-control']) !!}
</div>

<!-- Whatsapp 2 Field -->
<div class="form-group col-sm-4">
    {!! Form::label('whatsapp2', '2º Whatsapp:') !!}
    {!! Form::text('whatsapp2', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefone Field -->
<div class="form-group col-sm-4">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
</div>


@isset ($loja->fotos)
<div class="row">
    <div class="col-md-12 conteudo-centralizado">
        <image-slider :images="{{ $loja->fotos }}"></image-slider>
    </div>
</div>
@endisset

<div class="clearfix"></div>

<div class="form-group col-sm-12">
    <br>
    @include('fotos.aviso_upload')
    <upload-multiple-images v-model="files" v-on:upload="files = $event" :model="'App\\Models\\Loja'" :model_id="'{!! isset($oferta) ? intval($oferta->id) : null !!}'" :input_name="'fotos[]'" :post_url="'upload_image'"></upload-multiple-images>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
</div>

