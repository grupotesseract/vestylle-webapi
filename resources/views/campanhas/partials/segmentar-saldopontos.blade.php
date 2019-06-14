{{-- Div Segmentação por saldo de pontos --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_saldo_pontos', 'Por saldo de pontos') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_saldo_pontos', 1, $campanha->temSegmentacaoPontos ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoPontos) @else hide @endif">
        <!-- Condicao Saldo Pontos Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('condicao_saldo_pontos', 'Somente pessoas com saldo de pontos') !!}
            @include('campanhas.partials.select-condicoes', [
                'id' => 'condicao_saldo_pontos',
                'default' => isset($campanha) ? $campanha->condicao_saldo_pontos : null
                ])
        </div>
        <!-- Saldo Pontos Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('saldo_pontos', 'Saldo de pontos') !!}
            {!! Form::number('saldo_pontos', isset($campanha) ? $campanha->saldo_pontos : null, ['class' => 'form-control', 'min' => 0, 'step' => 1])  !!}
        </div>
    </div>
</div>
