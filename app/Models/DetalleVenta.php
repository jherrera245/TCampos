<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table='detalle_ventas';

    protected $primaryKey='id';

    protected $fillable=[
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_venta',
        'descuento',
        'status'
    ];
}
