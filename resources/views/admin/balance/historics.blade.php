@extends('adminlte::page')

@section('title', 'Historico - GoodBank')

@section('content_header')
    <h1>Historico da conta</h1>
    <ol class="breadcrumb">
        <li><a href="#"> Dashboard </a></li>
        <li><a href="#"> Historico </a></li>
      
    </ol>
@stop

@section('content')

   <div class="box">
       <div class="box-header">
         
       </div>
       
       <div class="box-body">
           <table class="table table-bordered table-hover">
               <thead>
                   <tr>
                       <th>#</th>
                       <th>Operação</th>
                       <th>Valor</th>
                       <th>Data</th>
                       <th>Enviado Para</th>
                   </tr>
               </thead>
               @foreach($historics as $listHistorics)
               <tbody>
                  
                   <tr>
                       <td> {{  $listHistorics->id    }}          </td>
                       <td> {{  $listHistorics->tipe($listHistorics->type)    }}  </td>
                       <td> R$: {{  number_format($listHistorics->amount, 2, ',', '.')    }}  </td>
                       <td> {{  $listHistorics->date    }}        </td>
                       <td>
                           @if($listHistorics->user_id_transfer) 
                                {{ $listHistorics->userOther->name }}
                           @else
                            -
                            @endif
                        </td>
                   </tr>
               </tbody>
               @endforeach
           </table>
       </div> 
   </div>
@stop