<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User; 

class historic extends Model
{
    //
    protected $fillable = [
        'type',
        'amount',
        'total_before',
        'total_after',
        'date',
        'user_id_transfer'
    ];
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function tipe($type = null)
    {
        $types = [
            'I' => 'Deposito',
            'O' => 'Saque',
            'T' => 'Transferência',
        ];
        if(!$type){
            return $types;
        }
        if($this->user_id_transfer != null && $type == 'I'){
            return 'Deposito Recebido';
        }
        return $types[$type];
    }
    public function userOther()
    {
         return $this->belongsTo(User::class, 'user_id_transfer');
    }
    public function filtra(Array $data, $totalPage){
        
        $historic = $this->where(function($query) use ($data){
            if(isset($data['id'])){
                $query->where('id', $data['id']);
            }
            if(isset($data['date'])){
                $query->where('date', $data['date']);
            }
            if(isset($data['type'])){
                $query->where('type', $data['type']);
            }
        })->paginate($totalPage);
       
        return $historic;
    }
}
