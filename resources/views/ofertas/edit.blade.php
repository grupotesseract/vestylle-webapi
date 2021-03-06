@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Produto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       @include('flash::message')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($oferta, ['route' => ['ofertas.update', $oferta->id], 'files' => true, 'method' => 'patch', 'id' => 'form-oferta']) !!}

                        @include('ofertas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

