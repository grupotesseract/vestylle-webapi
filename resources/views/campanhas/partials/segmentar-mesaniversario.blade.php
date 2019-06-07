{{-- Div Segmentação por mes de aniversario --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_mes_aniversario', 'Por mes_aniversario') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_mes_aniversario', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao hide">



        <!-- Mes Aniversario Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('mes_aniversario', 'Mes Aniversario:') !!}
            {!! Form::date('mes_aniversario', null, ['class' => 'form-control','id'=>'mes_aniversario']) !!}
        </div>

        <!-- Condicao Mes Aniversario Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('condicao_mes_aniversario', 'Condicao Mes Aniversario:') !!}
            {!! Form::text('condicao_mes_aniversario', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
