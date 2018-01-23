@extends('adminlte::page')

@section('title', 'Transferência - GoodBank')

@section('content_header')
    <h1>Transferir</h1>
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
          <h3>Tranferir Saldo(Informe o Recebedor)</h3>
       </div>
       
       <div class="box-body">
           <form method="POST" action="{{route('transfer.register')}}">
           {!! csrf_field() !!}
               <div class="form-group ">
                    <input name="nome_conta" type="text" placeholder="Informação de quem vai recebe saque (Nome ou E-mail)" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Próxima etapa</button>
               </div>
           </form>
       </div>
   </div>
@stop