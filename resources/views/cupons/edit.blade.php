@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cupom
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cupon, ['route' => ['cupons.update', $cupon->id], 'files' => true, 'method' => 'patch']) !!}

                        @include('cupons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
