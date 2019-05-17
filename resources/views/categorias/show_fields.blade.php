<div class="row">
    <div class="col-xs-6">
        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $categoria->id !!}</p>
        </div>

        <!-- Descricao Field -->
        <div class="form-group">
            {!! Form::label('descricao', 'Descricao:') !!}
            <p>{!! $categoria->descricao !!}</p>
        </div>

        <!-- Conteudo Field -->
        <div class="form-group">
            {!! Form::label('conteudo', 'Conteudo:') !!}
            <p>{!! $categoria->conteudo !!}</p>
        </div>

        <!-- Valor Field -->
        <div class="form-group">
            {!! Form::label('valor', 'Valor:') !!}
            <p>{!! $categoria->valor !!}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $categoria->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $categoria->updated_at !!}</p>
        </div>

        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $categoria->deleted_at !!}</p>
        </div>

    </div>

    <div class="col-xs-6">
        <hr>
        <!--  Pessoas -->
        <div class="form-group">
            {!! Form::label('pessoas', "Existem $categoria->numPessoas pessoas com essa categoria") !!}
            -
            <a class="btn btn-xs btn-info" href="{{ route('categorias.pessoas', $categoria->id)}}">
                <i class="fa fa-user"></i> - Ver Detalhes
            </a>
        </div>
        <hr>
        <!--  Ofertas -->
        <div class="form-group">
            {!! Form::label('ofertas', "Existem $categoria->numOfertas ofertas com essa categoria") !!}
            -
            <a class="btn btn-xs btn-info" href="{{ route('categorias.ofertas', $categoria->id)}}">
                <i class="fa fa-money"></i> - Ver Detalhes
            </a>
        </div>
        <hr>
        <!--  Cupons  -->
        <div class="form-group">
            {!! Form::label('cupons', "Existem $categoria->numCupons cupons com essa categoria") !!}
            -
            <a class="btn btn-xs btn-info" href="{{ route('categorias.cupons', $categoria->id)}}">
                <i class="fa fa-tag"></i> - Ver Detalhes
            </a>
        </div>


    </div>


</div>
