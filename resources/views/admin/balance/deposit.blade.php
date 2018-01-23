@extends('adminlte::page')

@section('title', 'Recargar - GoodBank')

@section('content_header')
    <h1>Nova Recarga</h1>
    <ol class="breadcrumb">
        <li><a href="#"> Dashboard </a></li>
        <li><a href="#"> Saldo </a></li>
        <li><a href="#"> Depositar </a></li>
    </ol>
@stop

@section('content')

   <div class="box">
       <div class="box-header">
            @include('msgError.valida')
          <h3>Fazer Recarga</h3>
       </div>
       
       <div class="box-body">
           <form method="POST" action="{{route('balance.store')}}">
           {!! csrf_field() !!}
               <div class="form-group ">
                    <input name="valor" type="text" placeholder="Valor da recarga" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Recarrega</button>
               </div>
           </form>
       </div>
   </div>
@stop