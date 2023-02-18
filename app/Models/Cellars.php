<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class Cellars extends Model
{
    use HasFactory, Uuids;

    protected $table = 'cellars';
    protected $primaryKey = '_id';

    protected $fillable = [
        'code',
        'dimension ',
        'name',
        'state',
        'addres',
    ];
}
