<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    protected $table = 'orden_detalle';
    protected $primaryKey = 'detalle_id';
    use HasFactory;
    protected $fillable = [
        'unidades',
        'total',
        'categorias_id',
    ];
}
