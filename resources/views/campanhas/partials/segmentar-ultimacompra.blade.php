{{-- Div Segmentação por data de última compra --}}
<div class="col-sm-12 container-item-segmentacao">

    <div class="col-sm-3">
        {!! Form::label('segmentar_data_ultima_compra', 'Por data da última compra') !!}
    </div>
    <div class="col-sm-9 text-left">
        {!! Form::checkbox('segmentar_data_ultima_compra', 1, $campanha->temSegmentacaoUltimaCompra ?? false, ['class'=>'checkbox-segmentacao']) !!} Sim
    </div>

    <div class="col-sm-12 item-segmentacao @if(isset($campanha) && $campanha->temSegmentacaoUltimaCompra) @else hide @endif">
        <!-- Data Ultima Compra Menor Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('data_ultima_compra_menor', 'Somente pessoas com data da última compra a partir de') !!}
            {!! Form::text('data_ultima_compra_menor', isset($campanha) ? $campanha->data_ultima_compra_menor : null
, ['class' => 'datepicker form-control','id'=>'data_ultima_compra_menor']) !!}
        </div>

        <!-- Data Ultima Compra Maior Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('data_ultima_compra_maior', 'Até') !!}
            {!! Form::text('data_ultima_compra_maior', isset($campanha) ? $campanha->data_ultima_compra_maior : null
, ['class' => 'datepicker form-control','id'=>'data_ultima_compra_maior']) !!}
        </div>

    </div>
</div>
