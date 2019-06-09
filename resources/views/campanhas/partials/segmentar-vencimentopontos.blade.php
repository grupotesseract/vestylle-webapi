{{-- Div Segmentação por data de vencimento dos pontos --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_data_vencimento_pontos', 'Por data_vencimento_pontos') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_data_vencimento_pontos', 1, $campanha->temSegmentacaoVencimentoPontos ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoVencimentoPontos) @else hide @endif">
        <!-- Data Vencimento Pontos Menor Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_vencimento_pontos_menor', 'Somente pessoas que tenham pontos vencendo a partir de') !!}
            {!! Form::text('data_vencimento_pontos_menor', isset($campanha) ? $campanha->data_vencimento_pontos_menor : null
, ['class' => 'datepicker form-control','id'=>'data_vencimento_pontos_menor']) !!}
        </div>

        <!-- Data Vencimento Pontos Maior Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('data_vencimento_pontos_maior', 'Até') !!}
            {!! Form::text('data_vencimento_pontos_maior', isset($campanha) ? $campanha->data_vencimento_pontos_maior : null
, ['class' => 'datepicker form-control','id'=>'data_vencimento_pontos_maior']) !!}
        </div>
    </div>
</div>

