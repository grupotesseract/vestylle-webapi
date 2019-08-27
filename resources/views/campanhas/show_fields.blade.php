<div class="col-xs-12">
    <div class="col-xs-6">
        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $campanha->id !!}</p>
        </div>

        @if ($campanha->titulo)
            <!-- Titulo Field -->
            <div class="form-group">
                {!! Form::label('titulo', 'Titulo:') !!}
                <p>{!! $campanha->titulo !!}</p>
            </div>
        @endif

        @if ($campanha->texto)
            <!-- Texto Field -->
            <div class="form-group">
                {!! Form::label('texto', 'Texto:') !!}
                <p>{!! $campanha->texto !!}</p>
            </div>
        @endif

        @if ($campanha->cupon_id)
            <!-- Cupon Id Field -->
            <div class="form-group">
                {!! Form::label('cupon_id', 'Cupom Id:') !!}
                <p>{!! $campanha->cupon_id !!}</p>
            </div>
        @endif

        @if ($campanha->oferta_id)
            <!-- Oferta Id Field -->
            <div class="form-group">
                {!! Form::label('oferta_id', 'Produto Id:') !!}
                <p>{!! $campanha->oferta_id !!}</p>
            </div>
        @endif

        @if ($campanha->genero)
            <!-- Genero Field -->
            <div class="form-group">
                {!! Form::label('genero', 'Genero:') !!}
                <p>{!! $campanha->genero !!}</p>
            </div>
        @endif

        @if ($campanha->data_ultima_compra_menor)
            <!-- Data Ultima Compra Menor Field -->
            <div class="form-group">
                {!! Form::label('data_ultima_compra_menor', 'Data Ultima Compra Menor:') !!}
                <p>{!! $campanha->data_ultima_compra_menor !!}</p>
            </div>
        @endif

        @if ($campanha->data_ultima_compra_maior)
            <!-- Data Ultima Compra Maior Field -->
            <div class="form-group">
                {!! Form::label('data_ultima_compra_maior', 'Data Ultima Compra Maior:') !!}
                <p>{!! $campanha->data_ultima_compra_maior !!}</p>
            </div>
        @endif

        @if ($campanha->data_vencimento_pontos_menor)
            <!-- Data Vencimento Pontos Menor Field -->
            <div class="form-group">
                {!! Form::label('data_vencimento_pontos_menor', 'Data Vencimento Pontos Menor:') !!}
                <p>{!! $campanha->data_vencimento_pontos_menor !!}</p>
            </div>
        @endif

        @if ($campanha->data_vencimento_pontos_maior)
            <!-- Data Vencimento Pontos Maior Field -->
            <div class="form-group">
                {!! Form::label('data_vencimento_pontos_maior', 'Data Vencimento Pontos Maior:') !!}
                <p>{!! $campanha->data_vencimento_pontos_maior !!}</p>
            </div>
        @endif
    </div>
    <div class="col-xs-6">

        @if ($campanha->ano_nascimento)
            <!-- Ano Nascimento Field -->
            <div class="form-group">
                {!! Form::label('ano_nascimento', 'Ano Nascimento:') !!}
                <p>{!! $campanha->ano_nascimento !!}</p>
            </div>
        @endif

        @if ($campanha->condicao_ano_nascimento)
            <!-- Condicao Ano Nascimento Field -->
            <div class="form-group">
                {!! Form::label('condicao_ano_nascimento', 'Condicao Ano Nascimento:') !!}
                <p>{!! $campanha->condicao_ano_nascimento !!}</p>
            </div>
        @endif

        @if ($campanha->mes_aniversario)
            <!-- Mes Aniversario Field -->
            <div class="form-group">
                {!! Form::label('mes_aniversario', 'Mes Aniversario:') !!}
                <p>{!! $campanha->mes_aniversario !!}</p>
            </div>
        @endif

        @if ($campanha->condicao_mes_aniversario)
            <!-- Condicao Mes Aniversario Field -->
            <div class="form-group">
                {!! Form::label('condicao_mes_aniversario', 'Condicao Mes Aniversario:') !!}
                <p>{!! $campanha->condicao_mes_aniversario !!}</p>
            </div>
        @endif

        @if ($campanha->saldo_pontos)
            <!-- Saldo Pontos Field -->
            <div class="form-group">
                {!! Form::label('saldo_pontos', 'Saldo Pontos:') !!}
                <p>{!! $campanha->saldo_pontos !!}</p>
            </div>
        @endif

        @if ($campanha->condicao_saldo_pontos)
            <!-- Condicao Saldo Pontos Field -->
            <div class="form-group">
                {!! Form::label('condicao_saldo_pontos', 'Condicao Saldo Pontos:') !!}
                <p>{!! $campanha->condicao_saldo_pontos !!}</p>
            </div>
        @endif

        @if ($campanha->created_at)
            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Data de Criação:') !!}
                <p>{!! $campanha->created_at !!}</p>
            </div>
        @endif

        @if ($campanha->updated_at)
            <!-- Updated At Field -->
            <div class="form-group">
                {!! Form::label('updated_at', 'Data de Atualização:') !!}
                <p>{!! $campanha->updated_at !!}</p>
            </div>
        @endif
    </div>

</div>
