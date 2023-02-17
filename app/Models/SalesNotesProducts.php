<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class SalesNotesProducts extends Model
{
    use HasFactory, Uuids;

    protected $table = 'sales_notes_products';
    protected $primaryKey = '_id';

    protected $fillable = [
        'amount',
        'description',
        'unit_value',
        'iva',
        'importe',
        'discount',
    ];

    //uno a varios
    public function salesNotes(){
        return $this->hasMany(SalesNotes::class);
    }
    public function products(){
        return $this->hasMany(Products::class);
    }
}
