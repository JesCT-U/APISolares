<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'pedidos';
    use HasFactory;
    protected $fillable = [
        'estado',
        'cantidad',
        'total',
        'productos_id',
    ];
}
