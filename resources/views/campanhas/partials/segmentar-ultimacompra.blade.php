{{-- Div Segmentação por data de ultima compra --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_data_ultima_compra', 'Por data_ultima_compra') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_data_ultima_compra', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao hide">
        <!-- Data Ultima Compra Menor Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_ultima_compra_menor', 'Data Ultima Compra Menor:') !!}
            {!! Form::date('data_ultima_compra_menor', null, ['class' => 'form-control','id'=>'data_ultima_compra_menor']) !!}
        </div>

        <!-- Data Ultima Compra Maior Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_ultima_compra_maior', 'Data Ultima Compra Maior:') !!}
            {!! Form::date('data_ultima_compra_maior', null, ['class' => 'form-control','id'=>'data_ultima_compra_maior']) !!}
        </div>

    </div>
</div>
