{{-- Div Segmentação por Genero --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_genero', 'Por genero') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_genero', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao hide">
        {{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
        @if (\Request::is('*edit*'))
            @include('pessoas.partials.select-genero', ['Model' => $campanha])
        @else
            @include('pessoas.partials.select-genero')
        @endif
    </div>
</div>
