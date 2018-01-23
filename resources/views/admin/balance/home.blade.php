@extends('adminlte::page')

@section('title', 'Saldo - GoodBank')

@section('content_header')
    <h1>Saldo</h1>
    <ol class="breadcrumb">
        <li><a href="#"> Dashboard </a></li>
        <li><a href="#"> Saldo </a></li>
    </ol>
@stop

@section('content')
    <div class="box">
    
        @include('msgError.valida')
        <div class="box-header">
           <a href="{{route('balance.deposit')}}" class="btn btn-primary ">Recargar <i class="fa fa-cart-plus"> </i></a>
           @if($valor > 0)
            <a href="{{route('balance.sake')}}" class="btn btn-danger "> Sacar <i class="fa fa-cart-plus"> </i></a>
            <a href="{{route('balance.transfer')}}" class="btn btn-info "> Transferência <i class="fa fa-exchange"> </i></a>
          @endif
        </div>
        <div class="box-body">
            <div>
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>R$:{{number_format($valor, 2, ".", "")}}</h3>

                  </div>
                  <div class="icon">
                    <i class="fa fa-money"></i>
                  </div>
                  <a href="{{route('admin.historic')}}" class="small-box-footer">Histórico <i class="fa fa-history"></i></a>
                </div>
              </div>
        </div>
    </div>
@stop