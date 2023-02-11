<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'parish',
        'sector',
        'neighborhood',
        'main_street',
        'back_street',
        'house_number',
        'reference'
    ];

//uno a uno
    /*
    public function trademark(){
        return $this->hasOne(Trademark::class);
    }
*/

//uno a varios
    public function customers(){
        return $this->hasOne(Customers::class);
    }

    public function cellars(){
        return $this->hasOne(Cellars::class);
    }
}
