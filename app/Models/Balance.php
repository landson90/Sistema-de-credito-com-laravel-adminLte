<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Balance extends Model
{
    public $temestamps = false;

    public function deposit($value)
    {

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0 ;
        $this->amount += number_format($value, 2, ".", "");
        $deposit = $this->save();

        $accountHistoric = auth()->user()->historics()->create([
            'type'          => 'I',
            'amount'        => $value,
            'total_before'  => $totalBefore,
            'total_after'   => $this->amount,
            'date'          => date('Ymd'),
        ]);

        if($deposit && $accountHistoric){
            
            DB::commit();

            return [
                'success' => true,
                'message' => 'Deposito realizada com sucesso !'
            ];
        }else{
            DB::rollbank();
            
            return [
                'success' => false,
                'message' => 'Deposito não realizada !'
            ];
        }
        
    }
    public function getSake($value)
    {
        if($this->amount < $value)
        return [
            'success' => false,
            'message' => 'Saldo insuficiênte.'
        ];
        DB::beginTransaction();
        
                $totalBefore     = $this->amount ? $this->amount : 0 ;
                $this->amount   -= number_format($value, 2, ".", "");
                $deposit         = $this->save();
        
                $accountHistoric = auth()->user()->historics()->create([
                    'type'          => 'O',
                    'amount'        => $value,
                    'total_before'  => $totalBefore,
                    'total_after'   => $this->amount,
                    'date'          => date('Ymd'),
                ]);
        
                if($deposit && $accountHistoric){
                    
                    DB::commit();
        
                    return [
                        'success' => true,
                        'message' => 'Saque realizada com sucesso !'
                    ];
                }else{
                    DB::rollbank();
                    
                    return [
                        'success' => false,
                        'message' => 'Saque não autorizado !'
                    ];
                }
                
    }
    public function getTransfer($value, User $user)
    {
        if($this->amount < $value)
        return [
            'success' => false,
            'message' => 'Saldo insuficiênte.'
        ];
        DB::beginTransaction();
        

        /*
        ========================================================================
        ATUALIZANDO DADOS DA CONTA QUE ESTÁ TRANFERINDO O SALDO
        ESTE CÓDIGO AQUI
        =========================================================================
        */
                $totalBefore     = $this->amount ? $this->amount : 0 ;
                $this->amount   -= number_format($value, 2, ".", "");
                $transaction     = $this->save();
        
                $historic = auth()->user()->historics()->create([
                    'type'          => 'T',
                    'amount'        => $value,
                    'total_before'  => $totalBefore,
                    'total_after'   => $this->amount,
                    'date'          => date('Ymd'),
                    'user_id_transfer' => $user->id
                ]);
               
               /*
            ========================================================================
            ATUALIZANDO DADOS DA CONTA QUE ESTÁ RECEBE A TRANSFERÊNCIA  O SALDO
            ESTE CÓDIGO AQUI!
            =========================================================================
        */
                $amountValue            = $user->balance()->firstOrCreate([]);
                $totalBalanceSeeder     = $amountValue->amount ? $amountValue->amount : 0 ;
                $amountValue->amount   += number_format($value, 2, ".", "");
                $transferSeeder         = $amountValue->save();
                    
                
                
                $historicSeeder = $user->historics()->create([
                    'type'              => 'I',
                    'amount'            => $value,
                    'total_before'      => $totalBalanceSeeder,
                    'total_after'       => $amountValue->amount,
                    'date'              => date('Ymd'),
                    'user_id_transfer'  => auth()->user()->id,
                    
                ]);
                
        
                if($transaction && $historic && $transferSeeder  && $historicSeeder ){
                    
                    DB::commit();
        
                    return [
                        'success' => true,
                        'message' => 'Sucesso ao transferir !'
                    ];
                }else{
                    DB::rollbank();
                    
                    return [
                        'success' => false,
                        'message' => 'Erro ao transferir !'
                    ];
                }
                
    }
}
