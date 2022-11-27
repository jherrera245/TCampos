<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'detalle_ventas';

    //columnas
    protected $fillable = [
        'id',
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_venta',
        'descuento',
        'status'
    ];
}

