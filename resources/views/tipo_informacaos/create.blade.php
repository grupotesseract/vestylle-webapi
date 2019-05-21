@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Informacao
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'tipoInformacaos.store']) !!}

                        @include('tipo_informacaos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
