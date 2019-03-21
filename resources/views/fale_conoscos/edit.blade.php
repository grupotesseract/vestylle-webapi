@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Fale Conosco
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($faleConosco, ['route' => ['faleConoscos.update', $faleConosco->id], 'method' => 'patch']) !!}

                        @include('fale_conoscos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection