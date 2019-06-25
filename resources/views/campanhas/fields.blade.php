<!-- Titulo Field -->
<div class="form-group col-sm-4">
    {!! Form::label('titulo', 'Titulo:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Texto Field -->
<div class="form-group col-sm-8">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('texto', null, ['class' => 'form-control']) !!}
</div>

<!-- Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('oferta_id', 'Oferta:') !!}
    {!! Form::select('oferta_id', $ofertas->pluck('titulo', 'id'), $campanha->oferta_id ?? null, ['class' => 'form-control', 'placeholder' => 'Escolha uma Oferta']) !!}
</div>

<!-- Oferta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cupon_id', 'Cupom:') !!}
    {!! Form::select('cupon_id', $cupons->pluck('titulo', 'id'), $campanha->cupon_id ?? null, ['class' => 'form-control', 'placeholder' => 'Escolha um Cupom']) !!}
</div>


<div class="col-sm-12">
    <h3>Opções de segmentação</h3>
    <br>

    @include('campanhas.partials.segmentar-categorias')

    @include('campanhas.partials.segmentar-genero')

    @include('campanhas.partials.segmentar-idade')

    @include('campanhas.partials.segmentar-mesaniversario')

    @include('campanhas.partials.segmentar-diaaniversario')

    @include('campanhas.partials.segmentar-saldopontos')

    @include('campanhas.partials.segmentar-vencimentopontos')

    @include('campanhas.partials.segmentar-ultimacompra')

</div>

<div class="col-sm-12">
    <hr>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campanhas.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')

    <script src="/js/campanhas.js"></script>

@endsection
