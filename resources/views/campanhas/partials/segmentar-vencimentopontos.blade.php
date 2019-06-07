{{-- Div Segmentação por data de vencimento dos pontos --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_data_vencimento_pontos', 'Por data_vencimento_pontos') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_data_vencimento_pontos', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao hide">
        <!-- Data Vencimento Pontos Menor Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_vencimento_pontos_menor', 'Data Vencimento Pontos Menor:') !!}
            {!! Form::date('data_vencimento_pontos_menor', null, ['class' => 'form-control','id'=>'data_vencimento_pontos_menor']) !!}
        </div>

        <!-- Data Vencimento Pontos Maior Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_vencimento_pontos_maior', 'Data Vencimento Pontos Maior:') !!}
            {!! Form::date('data_vencimento_pontos_maior', null, ['class' => 'form-control','id'=>'data_vencimento_pontos_maior']) !!}
        </div>
    </div>
</div>

