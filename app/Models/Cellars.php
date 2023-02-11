<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellars extends Model
{
    use HasFactory;

    protected $table = 'cellars';
    protected $fillable = [
        'code',
        'dimension ',
        'name',
        'state'
    ];

//uno a uno
    /*
    public function trademark(){
        return $this->hasOne(Trademark::class);
    }
*/

//uno a varios
    public function address(){
        return $this->hasOne(Address::class);
    }
}
