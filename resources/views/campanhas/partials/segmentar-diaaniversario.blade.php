@php
    $dias = [
        "" => "",
        1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27, 28 => 28, 29 => 29, 30 => 30, 31 => 31
    ];

@endphp

{{-- Div Segmentação por dia de aniversário --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_dia_aniversario', 'Por dia de aniversário') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_dia_aniversario', 1, $campanha->temSegmentacaoDiaAniversario ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoDiaAniversario) @else hide @endif">

        <!-- Condicao Dia Aniversario Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('condicao_dia_aniversario', 'Somente pessoas com dia de aniversário') !!}
            @include('campanhas.partials.select-condicoes', [
                'id' => 'condicao_dia_aniversario',
                'default' => isset($campanha) ? $campanha->condicao_dia_aniversario : null
                ])
        </div>
        <!-- Dia Aniversario Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('dia_aniversario', 'Dia de aniversário') !!}
            {!! Form::select('dia_aniversario', $dias, isset($campanha) ? $campanha->dia_aniversario : null, ['class' => 'form-control select-single','id'=>'dia_aniversario']) !!}
        </div>

    </div>
</div>
