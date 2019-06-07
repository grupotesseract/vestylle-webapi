{{-- Div Segmentação por Categoria --}}
<div class="col-sm-12 container-item-segmentacao">
    <div class="col-sm-3">
        {!! Form::label('segmentar_categorias', 'Por categorias') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_categorias', 1, $campanha->temSegmentacaoCategoria ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoCategoria) @else hide @endif">

        {{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
        @if (\Request::is('*edit*'))
            @include('categorias.partials.select', ['Model' => $campanha])
        @else
            @include('categorias.partials.select')
        @endif
    </div>
</div>
