<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesNotes extends Model
{
    use HasFactory;

    protected $table = 'sales_notes';

    protected $fillable = [
        'code',
        'invoice_number',
        'subtotal',
        'iva',
        'total',
        'state'
    ];

//uno a uno
    public function salesNotesProducts(){
        return $this->hasMany(SalesNotesProducts::class);
    }

//uno a varios
    public function users(){
        return $this->hasMany(User::class);
    }
}
