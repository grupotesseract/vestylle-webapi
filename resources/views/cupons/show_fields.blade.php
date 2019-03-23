<div class="col-md-6">
    <!-- Id Field -->
    <div class="form-group">
        {!! Form::label('id', 'Código:') !!}
        <p>{!! $cupon->id !!}</p>
    </div>

    <!-- Data Validade Field -->
    <div class="form-group">
        {!! Form::label('data_validade', 'Data de validade:') !!}
        <p>{!! $cupon->data_validade !!}</p>
    </div>

    <!-- Texto Cupom Field -->
    <div class="form-group">
        {!! Form::label('texto_cupom', 'Texto do cupom:') !!}
        <p>{!! $cupon->texto_cupom !!}</p>
    </div>

    <!-- Oferta Id Field -->
    <div class="form-group">
        {!! Form::label('oferta_id', 'Código da oferta:') !!}
        <p>{!! $cupon->oferta_id !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Criado em:') !!}
        <p>{!! $cupon->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Atualizado em:') !!}
        <p>{!! $cupon->updated_at !!}</p>
    </div>
</div>

@isset($cupon->oferta_id)
<div class="col-md-6">
    <!-- Foto da oferta -->
    <div class="form-group">
        <img src="{!! url('storage/' . $cupon->oferta->foto_oferta) !!}" width="300" height="300" alt="foto da oferta">
    </div>
</div>
@endisset
@if ($cupon->oferta_id == null)
<div class="col-md-6">
    <!-- Foto da oferta -->
    <div class="form-group">
        <img src="{!! url('storage/' . $cupon->foto_caminho) !!}" width="300" height="300" alt="foto do cupom">
    </div>
</div>
@endif
