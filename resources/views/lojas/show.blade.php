@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detalhes da loja -

            <div class="btn-group">
                <a class="btn btn-xs btn-default" href="{{ route('lojas.edit', $loja->id) }}"> <i class="fa fa-pencil"></i> Editar</a>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('lojas.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
