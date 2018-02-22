<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\historic;
use App\Http\Requests\Mony\MonyFormRequest;
use App\Http\Requests\Valida\NameFormRequest;
use App\User;

class SaldoController extends Controller
{
    //
    public function index()
    {
       $saldo = auth()->user()->balance;
       $valor = $saldo ? $saldo->amount : 0; 

        return view('admin.balance.home', compact('valor'));
    }
    //
    public function deposit()
    {
        return view('admin.balance.deposit');
    }
    //
    public function store(MonyFormRequest $request)
    {
    
      $balance = auth()->user()->balance()->firstOrCreate([]);
      
      $response =  $balance->deposit($request->valor);
       
      if($response['success']){
        return redirect()
                ->route('admin.balance')
                ->with ('success', $response['message']);
      }
      return redirect()
               ->back()
               ->with('error', $response['message']);
      
    }
    //
    public function cashOut()
    {
        return view('admin.balance.sake');
    }
    //
    public function getCashOut(MonyFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        
        $response =  $balance->getSake($request->valor);
         
        if($response['success']){
          return redirect()
                  ->route('admin.balance')
                  ->with ('success',$response['message']);
        }
        return redirect()
                 ->back()
                 ->with('error', $response['message']);
    }
    //
    public function transfer()
    {
        return view('admin.balance.transfer');
    }
    //
    public function confirTransfer(NameFormRequest $request, User $user)
    {
        

       if(!$searchFor = $user->getSearch($request->nome_conta))
           return redirect()
                    ->back()
                    ->with('error', 'Usuário não encontrados!');
       
       if($searchFor->id === auth()->user()->id)
       
        return redirect()
                 ->back()
                 ->with('error', 'Transferência não autorizada!');
     
         $saldo = auth()->user()->balance;

        return view('admin.balance.effectTransfer', compact('searchFor', 'saldo'));
        
    }
    public function storeTransfer(Request $request, User $user)
    {
        if(!$seeder = $user->find($request->idTransfer)){
            return redirect()
                    ->route('transfer.register')
                    ->with('error', 'Conta não encontrada!');
        }
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->getTransfer($request->valor, $seeder);

        if($response['success']){
            return redirect()
                    ->route('admin.balance')
                    ->with ('success',$response['message']);
          }
          return redirect()
                   ->back()
                   ->with('error', $response['message']);
    }
    //
    public function getHistoric(historic $type)
    {
        $historics = auth()->user()
                                ->historics()
                                ->with(['userOther'])
                                ->get();

        $type = $type->tipe();

        return view('admin.balance.historics', compact('historics', 'type'));
    }
    public function exbirFiltro(Request $request, historic $historic)
    {
       $dataForm = $request->all();
      
       $historics = $historic->filtra($dataForm);
      
       $type = $historic->tipe();
       
       return view('admin.balance.historics', compact('historics', 'type'));
    }
   
        
        
}
