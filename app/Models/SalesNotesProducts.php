<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesNotesProducts extends Model
{
    use HasFactory;

    protected $table = 'sales_notes_products';

    protected $fillable = [
        'amount',
        'unit_value',
        'iva',
        'total'
    ];

//uno a uno
    /*
    public function trademark(){
        return $this->hasOne(Trademark::class);
    }
*/

//uno a varios
    public function salesNotes(){
        return $this->hasMany(SalesNotes::class);
    }
    public function products(){
        return $this->hasMany(Products::class);
    }
}
