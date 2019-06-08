@php
    $meses = [
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    ];
@endphp

{{-- Div Segmentação por mes de aniversario --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_mes_aniversario', 'Por mes_aniversario') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_mes_aniversario', 1, $campanha->temSegmentacaoAniversario ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoAniversario) @else hide @endif">

        <!-- Condicao Mes Aniversario Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('condicao_mes_aniversario', 'Somente pessoas com mês de aniversario') !!}
            @include('campanhas.partials.select-condicoes', [
                'id' => 'condicao_mes_aniversario',
                'default' => isset($campanha) ? $campanha->condicao_mes_aniversario : null
                ])
        </div>
        <!-- Mes Aniversario Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('mes_aniversario', 'Mes de aniversario') !!}
            {!! Form::select('mes_aniversario', $meses, isset($campanha) ? $campanha->mes_aniversario : null, ['class' => 'form-control select-single','id'=>'mes_aniversario']) !!}
        </div>

    </div>
</div>
