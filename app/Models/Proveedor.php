<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'proveedor_id';
    use HasFactory;
    protected $fillable = [
        'codigo',
        'proveedor',
        'nit',
        'estado',
    ];
}
