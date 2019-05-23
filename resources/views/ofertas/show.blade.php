@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detalhes da oferta -

            <div class="btn-group">
                <a class="btn btn-xs btn-default" href="{{ route('ofertas.edit', $oferta->id) }}"> <i class="fa fa-pencil"></i> Editar</a>
            </div>
            <div class="btn-group pull-right">
                <a class="btn btn-default" href="{{ route('ofertas.index') }}"> Voltar </a>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('ofertas.show_fields')

                    <hr>
                    <br>


                    <div class="col-xs-12">
                    <h4>Pessoas que adicionaram essa oferta á lista de desejos:</h4>

                    <br>
                    @include('pessoas.table')

                    </div>
                    <a href="{!! route('ofertas.index') !!}" class="btn btn-default">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
