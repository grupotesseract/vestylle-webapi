@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Pessoas que podem ver a oferta: {{$oferta->titulo}}

            <span class="pull-right">
                <a class="btn btn-default" href="javascript:history.back()"> Voltar</a>
            </span>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('pessoas.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

