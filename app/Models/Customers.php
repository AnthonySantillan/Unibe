<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class Customers extends Model
{
    use HasFactory, Uuids;

    protected $table = 'customers';
    protected $primaryKey = '_id';

    protected $fillable = [
        'identification_card',
        'name',
        'last_name',
        'email',
        'phone',
        'role',
        'state'
    ];

    //uno a varios
    public function user(){
        return $this->hasOne(User::class);
    }
    public function address(){
        return $this->hasOne(Address::class);
    }
}
