<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'identification_card',
        'name',
        'last_name',
        'email',
        'phone',
        'role',
        'state'
    ];

//uno a uno
    /*
    public function trademark(){
        return $this->hasOne(Trademark::class);
    }
*/

//uno a varios
    public function user(){
        return $this->hasOne(User::class);
    }
    public function address(){
        return $this->hasOne(Address::class);
    }
}
