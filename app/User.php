<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Balance;
use App\Models\historic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function balance()
    {
        return $this->hasOne(Balance::class);
    }
    public function historics()
    {
        return $this->hasMany(historic :: class);
    }
    public function getSearch($search)
    {
        return $this->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', $search)
                    ->get()
                    ->first();
    }
}
