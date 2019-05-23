@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detalhes do cupom -

            <div class="btn-group">
                <a class="btn btn-xs btn-primary" href="{{ route('qrcode', $cupon->id) }}">Gerar QRCode</a>
            </div>

            <div class="btn-group">
                <a class="btn btn-xs btn-default" href="{{ route('cupons.edit', $cupon->id) }}"> <i class="fa fa-pencil"></i> Editar</a>
            </div>
            <div class="btn-group pull-right">
                <a class="btn btn-default" href="{{ route('cupons.index') }}"></a>
            </div>
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('cupons.show_fields')

                    <hr>
                    <br>

                    <div class="col-xs-12">
                    <h4>Pessoas que ativaram esse cupom</h4>

                    <br>
                    @include('pessoas.table')

                    </div>
                    <a href="{!! route('cupons.index') !!}" class="btn btn-default">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
