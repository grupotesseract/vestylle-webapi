@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cupom
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('cupons.show_fields')


                    <hr>
                    <br>


                    <div class="col-xs-12">
                    <h4>Pessoas que ativaram esse cupomÇ</h4>

                    <br>
                    @include('pessoas.table')

                    </div>
                    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
