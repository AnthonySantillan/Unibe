<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class Address extends Model
{
    use HasFactory, Uuids;

    protected $table = 'address';

    protected $fillable = [
        'city',
        'parish',
        'sector',
        'neighborhood',
        'main_street',
        'back_street',
        'house_number',
        'reference'
    ];

    //uno a varios
    public function customers(){
        return $this->hasOne(Customers::class);
    }

    public function cellars(){
        return $this->hasOne(Cellars::class);
    }
}
