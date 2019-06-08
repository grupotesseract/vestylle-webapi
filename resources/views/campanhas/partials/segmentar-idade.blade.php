@php

    $anoMin = \Carbon\Carbon::now()->year - 100;
    $anoMax = \Carbon\Carbon::now()->year;

@endphp

{{-- Div Segmentação por Idade --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_idade', 'Por idade') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_idade', 1, $campanha->temSegmentacaoIdade ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoIdade) @else hide @endif">
        <!-- Condicao Ano Nascimento Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('condicao_ano_nascimento', 'Somente pessoas com ano de nascimento') !!}
            @include('campanhas.partials.select-condicoes', [
                'id' => 'condicao_ano_nascimento',
                'default' => isset($campanha) ? $campanha->condicao_ano_nascimento : null
            ])
        </div>
        <!-- Ano Nascimento Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('ano_nascimento', 'Ano Nascimento:') !!}
            {!! Form::number('ano_nascimento', isset($campanha) ? $campanha->ano_nascimento : null, ['class' => 'form-control','id'=>'ano_nascimento', 'min' => $anoMin, 'max' => $anoMax, 'step' => 1])  !!}
        </div>
    </div>
</div>
