<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Título da Oferta') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('subtitulo', 'Subtítulo da Oferta') !!}
    {!! Form::text('subtitulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Oferta Field -->
<div class="form-group col-sm-12">
    {!! Form::label('texto_oferta', 'Texto da Oferta') !!}
    {!! Form::text('texto_oferta', null, ['class' => 'form-control']) !!}
</div>

<!-- Descricao Oferta Field -->
<div class="form-group col-sm-12">
    {!! Form::label('descricao_oferta', 'Descrição da oferta') !!}
    {!! Form::textarea('descricao_oferta', null, ['class' => 'form-control']) !!}
</div>

{{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
@if (\Request::is('*edit*'))
    @include('categorias.partials.select', ['Model' => $oferta])
@else
    @include('categorias.partials.select')
@endif

@isset ($oferta->fotos)
<div class="row">
    <div class="col-md-6">
        <image-slider :images="{{ $oferta->fotos }}"></image-slider>
    </div>
</div>
@endisset

<div class="clearfix"></div>

<div class="form-group col-sm-12">
    <upload-multiple-images v-model="files" v-on:upload="files = $event" :model="'App\\Models\\Oferta'" :model_id="'{!! isset($oferta) ? intval($oferta->id) : null !!}'" :input_name="'fotos[]'" :post_url="'upload_image'"></upload-multiple-images>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ofertas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
