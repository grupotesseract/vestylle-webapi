@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cupon
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cupon, ['route' => ['cupons.update', $cupon->id], 'method' => 'patch']) !!}

                        @include('cupons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection