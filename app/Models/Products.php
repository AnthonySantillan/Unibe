<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'name',
        'description',
        'price',
        'total',
        'state'
    ];

//uno a uno
    /*
    public function trademark(){
        return $this->hasOne(Trademark::class);
    }
*/

//uno a varios
    public function salesNotesProducts(){
        return $this->hasMany(SalesNotesProducts::class);
    }
    public function cellars(){
        return $this->hasMany(Cellars::class);
    }
}
