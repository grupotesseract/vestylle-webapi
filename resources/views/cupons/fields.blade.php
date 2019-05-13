<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Título') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('subtitulo', 'Subtítulo') !!}
    {!! Form::text('subtitulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Validade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_validade', 'Valido até') !!}
    {!! Form::date('data_validade', $cupon->data_validade ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Cupom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto_cupom', 'Texto') !!}
    {!! Form::text('texto_cupom', null, ['class' => 'form-control']) !!}
</div>

<!-- Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('oferta_id', 'Descrição da Oferta:') !!}
    {!! Form::select('oferta_id', $ofertas->pluck('descricao_oferta', 'id'), $cupon->oferta_id ?? null, ['class' => 'form-control', 'placeholder' => 'Escolha uma Oferta']) !!}
</div>

@if (isset($cupon->fotos) && is_null($cupon->oferta_id))
<div class="row">
    <div class="col-md-6">
        <image-slider :images="{{ $cupon->fotos }}"></image-slider>
    </div>
</div>
@endif

@isset ($cupon->oferta->fotos)
<div class="row">
    <div class="col-md-6">
        <image-slider :images="{{ $cupon->oferta->fotos }}"></image-slider>
    </div>
</div>
@endisset

<div class="form-group col-sm-12">
    <upload-multiple-images v-model="files" v-on:upload="files = $event" :model="'App\\Models\\Cupon'" :model_id="'{!! isset($cupon) ? intval($cupon->id) : null !!}'" :input_name="'fotos[]'" :post_url="'upload_image'"></upload-multiple-images>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Cancelar</a>
</div>
