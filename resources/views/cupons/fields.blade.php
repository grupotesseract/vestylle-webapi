<div class="form-group col-sm-3">
    {!! Form::label('titulo', 'Título') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('subtitulo', 'Subtítulo') !!}
    {!! Form::text('subtitulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Validade Field -->
<div class="form-group col-sm-2">
    {!! Form::label('data_validade', 'Valido Até') !!}
    {!! Form::date('data_validade', $cupon->data_validade ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Aparece na listagem Field -->
<div class="form-group col-sm-3">
    {!! Form::label('aparece_listagem', 'Aparece na listagem de cupons') !!} <br>
    {!! Form::radio('aparece_listagem', true, $cupon->aparece_listagem ?? true, ['class' => '']) !!} Sim &nbsp;
    {!! Form::radio('aparece_listagem', 0, $cupon->aparece_listagem ?? false, ['class' => '']) !!} Não
    <br>
</div>

<!-- Oferta Field -->
<div class="form-group col-sm-5">
    {!! Form::label('oferta_id', 'Oferta:') !!}
    {!! Form::select('oferta_id', $ofertas->pluck('titulo', 'id'), $cupon->oferta_id ?? null, ['class' => 'form-control', 'placeholder' => 'Escolha uma Oferta']) !!}
</div>

<!-- Porcentagem OFF Field -->
<div class="form-group col-sm-1">
    {!! Form::label('porcentagem_off', '% OFF') !!}
    {!! Form::text('porcentagem_off', $cupon->porcentagem_off ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Cupom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto_cupom', 'Texto descritivo') !!}
    {!! Form::text('texto_cupom', $cupon->texto_cupom ?? null, ['class' => 'form-control']) !!}
</div>


{{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
@if (\Request::is('*edit*'))
    @include('categorias.partials.select', ['Model' => $cupon])
@else
    @include('categorias.partials.select')
@endif

@if (isset($cupon->fotos))
<div class="row">
    <div class="col-md-12 conteudo-centralizado">
        <image-slider :images="{{ $cupon->fotos }}"></image-slider>
    </div>
</div>
@else
    @if (isset($cupon->oferta->fotos))
        <div class="row">
            <div class="col-md-12  conteudo-centralizado ">
                <image-slider :images="{{ $cupon->oferta->fotos }}"></image-slider>
            </div>
        </div>
    @endif
@endif

<div class="form-group col-sm-12">
    <br>

    @include('fotos.aviso_upload')

    <upload-multiple-images v-model="files" v-on:upload="files = $event" :model="'App\\Models\\Cupon'" :model_id="'{!! isset($cupon) ? intval($cupon->id) : null !!}'" :input_name="'fotos[]'" :post_url="'upload_image'"></upload-multiple-images>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Cancelar</a>
</div>
