<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Products extends Model
{
    use HasFactory, Uuids;

    protected $table = 'products';
    protected $primaryKey = '_id';

    protected $fillable = [
        'code',
        'name',
        'description',
        'price',
        'total',
        'state'
    ];

    //uno a varios
    public function salesNotesProducts(){
        return $this->hasMany(SalesNotesProducts::class);
    }
    public function cellars(){
        return $this->hasMany(Cellars::class);
    }
}
