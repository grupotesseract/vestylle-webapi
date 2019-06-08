{{-- Div Segmentação por Idade --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_idade', 'Por idade') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_idade', 1, $campanha->temSegmentacaoIdade ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoIdade) @else hide @endif">
        <!-- Condicao Idade Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('condicao_idade', 'Somente pessoas com idade') !!}
            @include('campanhas.partials.select-condicoes', [
                'id' => 'condicao_idade',
                'default' => isset($campanha) ? $campanha->condicao_idade : null
            ])
        </div>
        <!-- Idade Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('idade', 'Idade (anos)') !!}
            {!! Form::number('idade', isset($campanha) ? $campanha->idade : null, ['class' => 'form-control','id'=>'ano_nascimento', 'min' => 0, 'max' => 99, 'step' => 1])  !!}
        </div>
    </div>
</div>
