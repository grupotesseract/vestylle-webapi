{{-- Div Segmentação por Idade --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_idade', 'Por idade') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_idade', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao hide">
        <!-- Ano Nascimento Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('ano_nascimento', 'Ano Nascimento:') !!}
            {!! Form::date('ano_nascimento', null, ['class' => 'form-control','id'=>'ano_nascimento']) !!}
        </div>

        <!-- Condicao Ano Nascimento Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('condicao_ano_nascimento', 'Condicao Ano Nascimento:') !!}
            {!! Form::text('condicao_ano_nascimento', null, ['class' => 'form-control']) !!}
        </div>

    </div>
</div>
