<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
    protected $primaryKey = 'orden_id';
    use HasFactory;
    protected $fillable = [
        'codigo',
        'fecha',
        'total',
        'estado',
    ];
}
