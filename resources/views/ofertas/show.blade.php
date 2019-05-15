@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Oferta
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
