<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Uuids;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    protected $primaryKey = '_id';

    protected $fillable = [
        'username',
        'password',
        'email',
        'state',
        'type',
        'api_token'
    ];

    //uno a varios
    public function customer(){
        return $this->hasOne(Customers::class);
    }
}
