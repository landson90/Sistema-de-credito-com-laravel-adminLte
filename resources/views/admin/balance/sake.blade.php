@extends('adminlte::page')

@section('title', 'Saque - GoodBank')

@section('content_header')
    <h1>Realiza Saque</h1>
    <ol class="breadcrumb">
        <li><a href="#"> Dashboard </a></li>
        <li><a href="#"> Saldo </a></li>
        <li><a href="#"> Saque </a></li>
    </ol>
@stop

@section('content')

   <div class="box">
       <div class="box-header">
            @include('msgError.valida')
          <h3>Fazer Saque</h3>
       </div>
       
       <div class="box-body">
           <form method="POST" action="{{route('balance.CashOut')}}">
           {!! csrf_field() !!}
               <div class="form-group ">
                    <input name="valor" type="text" placeholder="Valor da recarga" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Sacar</button>
               </div>
           </form>
       </div>
   </div>
@stop