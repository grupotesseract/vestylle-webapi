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
    {!! Form::text('data_validade', $cupon->data_validade ?? null, ['class' => 'datepicker form-control']) !!}
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

<div class="conteudo-aparece-listagem">

<div class="col-xs-12">
    <hr>
</div>

<!-- Aparece na listagem Field -->
<div class="form-group col-sm-12">

    <div class="col-sm-5">
        <h4>Cupom disponivel em 'Meus Cupons'? <br>
            <span class="small">(se não, o cupom só podera ser ativado via código ou QRCode)</span>
        </h4>
    </div>

    <div class="col-sm-7 text-left">
        <h4> {!! Form::checkbox('aparece_listagem', 1, isset($cupon) ? $cupon->aparece_listagem : true, ['class' => 'checkbox_aparece_listagem']) !!} Sim </h4>
    </div>
</div>

<!-- Cupom em destaque? aparece na Home -->
<div class="form-group col-sm-12 container-cupom-destaque">
    <div class="col-xs-12">
        <hr>
    </div>

    <div class="col-sm-5">
        <h4>Cupom em destaque? <br>
            <span class="small">(aparece na página inicial)</span>
        </h4>
    </div>

    <div class="col-sm-7 text-left">
        <h4> {!! Form::checkbox('em_destaque', 1, null ['chekbox_em_destaque']) !!} Sim </h4>
    </div>

    <div class="conteudo-destaque hide col-sm-12">

        @include('fotos.aviso_upload', [
            'titulo' => 'Atenção!',
            'conteudo' => 'Para que a foto do cupom na página inicial fique correta, é necessario que ela seja quadrada, idealmente 500x500'
        ])

        <!-- Foto da Home Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('foto_homepage', 'Selecione uma foto para o cupom na página inicial:') !!} <br>
            {!! Form::file('foto_homepage' ) !!}
        </div>



    </div>


</div>


</div>

<div class="col-xs-12">
    <hr>

    <div class="col-sm-12">
        <h4>Fotos do cupom <br>
            <span class="small">(aparecem em 'meus cupons' e na tela interna do cupom)</span>
        </h4>
        <br>
        @include('fotos.aviso_upload', [
            'titulo' => 'Atenção!',
            'conteudo' => 'As fotos da listagem e página interna do cupom, são retangulares com proporção 2:1. Por exemplo 500x250'
        ])
    </div>
</div>


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


    <upload-multiple-images v-model="files" v-on:upload="files = $event" :model="'App\\Models\\Cupon'" :model_id="'{!! isset($cupon) ? intval($cupon->id) : null !!}'" :input_name="'fotos[]'" :post_url="'upload_image'"></upload-multiple-images>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Cancelar</a>
</div>



@section('scripts')

    <script src="/js/cupons.js"></script>

@endsection
