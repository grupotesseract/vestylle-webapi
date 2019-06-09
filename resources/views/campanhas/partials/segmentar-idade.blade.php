{{-- Div Segmentação por Idade --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_data_nascimento', 'Por data de nascimento') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_data_nascimento', 1, $campanha->temSegmentacaoIdade ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoIdade) @else hide @endif">
        <!-- Data nascimento Menor Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_nascimento_menor', 'Somente pessoas que tenham nascido a partir de') !!}
            {!! Form::text('data_nascimento_menor', isset($campanha) ? $campanha->data_nascimento_menor : null , ['class' => 'datepicker form-control','id'=>'data_nascimento_menor']) !!}
        </div>
        <!-- Data nascimento maior Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('data_nascimento_maior', 'Até') !!}
            {!! Form::text('data_nascimento_maior', isset($campanha) ? $campanha->data_nascimento_maior : null, ['class' => 'form-control datepicker'])  !!}
        </div>
    </div>
</div>
