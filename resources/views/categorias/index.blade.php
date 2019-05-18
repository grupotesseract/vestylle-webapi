@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Categorias</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('categorias.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

