<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesNotes extends Model
{
    use HasFactory;

    protected $table = 'sales_notes';
    protected $primaryKey = '_id';

    protected $fillable = [
        'iva',
        'total',
        'state',
        'subtotal',
        'discount',
        'date',
        'observation',
        'forma_pago',
        'invoice_number',
    ];

//uno a uno
    public function salesNotesProducts(){
        return $this->hasMany(SalesNotesProducts::class);
    }

//uno a varios
    public function users(){
        return $this->hasMany(User::class);
    }

    public function customers(){
        return $this->hasOne(Customers::class);
    }
}
