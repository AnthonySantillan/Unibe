<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class SalesNotes extends Model
{
    use HasFactory, Uuids;

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
        return $this->belongsTo(SalesNotesProducts::class);
    }

//uno a varios
    public function users(){
        return $this->hasMany(User::class);
    }

    public function customers(){
        return $this->hasOne(Customers::class);
    }
}
