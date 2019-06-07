{{-- Div Segmentação por saldo de pontos --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_saldo_pontos', 'Por saldo_pontos') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_saldo_pontos', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao hide">
        <!-- Saldo Pontos Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('saldo_pontos', 'Saldo Pontos:') !!}
            {!! Form::date('saldo_pontos', null, ['class' => 'form-control','id'=>'saldo_pontos']) !!}
        </div>

        <!-- Condicao Saldo Pontos Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('condicao_saldo_pontos', 'Condicao Saldo Pontos:') !!}
            {!! Form::text('condicao_saldo_pontos', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
