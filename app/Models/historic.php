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
        return $types[$type];
    }
    public function userOther()
    {
         return $this->belongsTo(User::class, 'user_id_transfer');
    }
}
