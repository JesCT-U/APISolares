<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reabastecimiento extends Model
{
    protected $table = 'reabastecimiento';
    protected $primaryKey = 'reabastecimiento_id';
    use HasFactory;
    protected $fillable = [
        'unidades',
        'Total',
        'fecha',
        'productos_id',
        'proveedor_id',
        'estado',
    ];
}
