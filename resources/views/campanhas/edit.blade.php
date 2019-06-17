@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Campanha
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($campanha, ['route' => ['campanhas.update', $campanha->id], 'method' => 'patch']) !!}

                        @include('campanhas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection