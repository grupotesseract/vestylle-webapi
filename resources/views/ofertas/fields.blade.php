<!-- Descricao Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descricao_oferta', 'Descrição da oferta') !!}
    {!! Form::text('descricao_oferta', null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto_oferta', 'Texto da oferta') !!}
    {!! Form::text('texto_oferta', null, ['class' => 'form-control']) !!}
</div>


{{-- Campos para o UPLOAD / CROP de foto. Só incluindo o crop no edit --}}
<div class="form-group col-sm-12 text-center">
    @if (\Route::is('*edit*'))

        <img id="foto-oferta" class="" src="{{$oferta->urlFoto}}" alt=""/>

        @include('fotos.upload', [
            'comCropper' => true,
            'aspectRatio' => 1,
            'formID' => '#form-oferta',
            'previewID' => '#foto-oferta'
        ])
    @else
        @include('fotos.upload', [
            'comCropper' => false,
            'aspectRatio' => 1,
            'formID' => '#form-oferta',
            'previewID' => '#foto-oferta'
        ])
    @endif
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ofertas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
