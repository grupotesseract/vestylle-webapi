<div class="col-xs-12">

    <div class="col-xs-6">
        @if ($pessoa->id)
            <!-- Id Field -->
            <div class="form-group">
                {!! Form::label('id', 'Id:') !!}
                <p>{!! $pessoa->id !!}</p>
            </div>
        @endif

        @if ($pessoa->id_vestylle)
            <!-- Id Vestylle Field -->
            <div class="form-group">
                {!! Form::label('id_vestylle', 'Id da Vestylle:') !!}
                <p>{!! $pessoa->id_vestylle !!}</p>
            </div>
        @endif

        @if ($pessoa->saldo_pontos)
            <!-- Saldo Pontos Field -->
            <div class="form-group">
                {!! Form::label('saldo_pontos', 'Saldo de Pontos:') !!}
                <p>{!! $pessoa->saldo_pontos !!}</p>
            </div>
        @endif

        @if ($pessoa->celular)
            <!-- Celular Field -->
            <div class="form-group">
                {!! Form::label('celular', 'Celular:') !!}
                <p>{!! $pessoa->celular !!}</p>
            </div>
        @endif

        @if ($pessoa->telefone_fixo)
            <!-- Telefone Fixo Field -->
            <div class="form-group">
                {!! Form::label('telefone_fixo', 'Telefone Fixo:') !!}
                <p>{!! $pessoa->telefone_fixo !!}</p>
            </div>
        @endif

        @if ($pessoa->email)
            <!-- Email Field -->
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                <p>{!! $pessoa->email !!}</p>
            </div>
        @endif

        @if ($pessoa->nome)
            <!-- Nome Field -->
            <div class="form-group">
                {!! Form::label('nome', 'Nome:') !!}
                <p>{!! $pessoa->nome !!}</p>
            </div>
        @endif

        @if ($pessoa->cpf)
            <!-- Cpf Field -->
            <div class="form-group">
                {!! Form::label('cpf', 'CPF:') !!}
                <p>{!! $pessoa->cpf !!}</p>
            </div>
        @endif

        @if ($pessoa->categorias()->count())
            <!-- Categorias da pessoa -->
            <div class="form-group">
                {!! Form::label('Categorias', 'Categorias:') !!}
                <ul>
                    @foreach ($pessoa->categorias as $categoria)
                        <li>{{$categoria->nome}} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($pessoa->cep)
            <!-- Cep Field -->
            <div class="form-group">
                {!! Form::label('cep', 'CEP:') !!}
                <p>{!! $pessoa->cep !!}</p>
            </div>
        @endif

    </div>
    <div class="col-xs-6">
        @if ($pessoa->endereco)
            <!-- Endereco Field -->
            <div class="form-group">
                {!! Form::label('endereco', 'Endereço:') !!}
                <p>{!! $pessoa->endereco !!}</p>
            </div>
        @endif

        @if ($pessoa->numero)
            <!-- Numero Field -->
            <div class="form-group">
                {!! Form::label('numero', 'Número:') !!}
                <p>{!! $pessoa->numero !!}</p>
            </div>
        @endif

        @if ($pessoa->bairro)
            <!-- Bairro Field -->
            <div class="form-group">
                {!! Form::label('bairro', 'Bairro:') !!}
                <p>{!! $pessoa->bairro !!}</p>
            </div>
        @endif


        @if ($pessoa->complemento)
            <!-- Complemento Field -->
            <div class="form-group">
                {!! Form::label('complemento', 'Complemento:') !!}
                <p>{!! $pessoa->complemento !!}</p>
            </div>
        @endif

        @if ($pessoa->data_ultima_compra)
            <!-- Data Ultima Compra Field -->
            <div class="form-group">
                {!! Form::label('data_ultima_compra', 'Data da Última Compra:') !!}
                <p>{!! $pessoa->data_ultima_compra !!}</p>
            </div>
        @endif

        @if ($pessoa->data_nascimento)
            <!-- Data Nascimento Field -->
            <div class="form-group">
                {!! Form::label('data_nascimento', 'Data de Nascimento:') !!}
                <p>{!! $pessoa->data_nascimento !!}</p>
            </div>
        @endif

        @if ($pessoa->cidade_id)
            <!-- Cidade Id Field -->
            <div class="form-group">
                {!! Form::label('cidade_id', 'Id da Cidade:') !!}
                <p>{!! $pessoa->cidade_id !!}</p>
            </div>
        @endif

        @if ($pessoa->created_at)
            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Data de Criação:') !!}
                <p>{!! $pessoa->created_at !!}</p>
            </div>
        @endif

        @if ($pessoa->updated_at)
            <!-- Updated At Field -->
            <div class="form-group">
                {!! Form::label('updated_at', 'Data de Atualização:') !!}
                <p>{!! $pessoa->updated_at !!}</p>
            </div>
        @endif

        @if ($pessoa->deleted_at)
            <!-- Deleted At Field -->
            <div class="form-group">
                {!! Form::label('deleted_at', 'Data de Exclusão:') !!}
                <p>{!! $pessoa->deleted_at !!}</p>
            </div>
        @endif


    </div>
</div>
