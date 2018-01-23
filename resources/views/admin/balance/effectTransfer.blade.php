@extends('adminlte::page')

@section('title', 'Transferência - GoodBank')

@section('content_header')
    <h1>Confirmar transferência</h1>
    <ol class="breadcrumb">
        <li><a href="#"> Dashboard </a></li>
        <li><a href="#"> Saldo </a></li>
        <li><a href="#"> Transferência </a></li>
    </ol>
@stop

@section('content')

   <div class="box">
       <div class="box-header">
            @include('msgError.valida')
          <h3>Informe valor para transferência</h3>
       </div>
       
       <div class="box-body">
           <form method="POST" action="{{route('confirm.transfer')}}">
           {!! csrf_field() !!}
           <p> <strong>Recebedor: </strong>{{$searchFor->name}}</p>
           <input type="hidden" name="idTransfer" value="{{ $searchFor->id  }}">
               <div class="form-group ">
                    <input name="valor" type="text" placeholder="Valor R$:" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Confirmar Transferência</button>
               </div>
           </form>
       </div>
   </div>
@stop