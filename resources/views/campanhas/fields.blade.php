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
    <h3>Segmentação</h3>
    <br>

    {{-- Div Segmentação por Categoria --}}
    <div class="col-sm-12 container-item-segmentacao">

        <div class="col-sm-3">
            {!! Form::label('segmentar_categorias', 'Por categorias') !!}
        </div>
        <div class="col-sm-9 text-left">
            {!! Form::checkbox('segmentar_categorias', 1, $campanha->temSegmentacaoCategoria ?? 1, ['class'=>'checkbox-segmentacao']) !!} Sim
        </div>

        <div class="item-segmentacao @if(!$campanha->temSegmentacaoCategoria) hide @endif">

                {{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
                @if (\Request::is('*edit*'))
                    @include('categorias.partials.select', ['Model' => $campanha])
                @else
                    @include('categorias.partials.select')
                @endif
        </div>
    </div>


    {{-- Div Segmentação por Genero --}}
    <div class="col-sm-12 container-item-segmentacao">

        <div class="col-sm-3">
            {!! Form::label('segmentar_genero', 'Por genero') !!}
        </div>
        <div class="col-sm-9 text-left">
            {!! Form::checkbox('segmentar_genero', 0, 0, ['class'=>'checkbox-segmentacao']) !!} Sim
        </div>

        <div class="col-sm-12 item-segmentacao hide">
            {{-- Incluindo o select de categorias, Passando 'Model' se estiver editando --}}
            @if (\Request::is('*edit*'))
                @include('pessoas.partials.select-genero', ['Model' => $campanha])
            @else
                @include('pessoas.partials.select-genero')
            @endif
        </div>
    </div>

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

</div>

<div class="col-sm-12">
    <hr>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campanhas.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')

    <script src="/js/campanhas.js"></script>

@endsection
