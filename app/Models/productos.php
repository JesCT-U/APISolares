<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'productos_id';
    use HasFactory;
    protected $fillable = [
        'codigo',
        'producto',
        'descripcion',
        'precio',
        'precio_compra',
        'stock',
        'stock_min',
        'estado',
        'categorias_id',
    ];
}
