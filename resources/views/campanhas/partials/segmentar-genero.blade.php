{{-- Div Segmentação por Genero --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_genero', 'Por genero') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_genero', 1, $campanha->temSegmentacaoGenero ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoGenero) @else hide @endif">
        {{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
        @if (\Request::is('*edit*'))
            @include('pessoas.partials.select-genero', [
                'Model' => $campanha,
                'label' => 'Somente pessoas de genero'
            ])
        @else
            @include('pessoas.partials.select-genero', [
                'label' => 'Somente pessoas de genero'
            ])
        @endif
    </div>
</div>
