<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngresos extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'detalle_ingresos';

    //columnas
    protected $fillable = [
        'id',
        'id_ingreso',
        'id_producto',
        'cantidad',
        'precio_compra',
        'precio_venta',
        'status'
    ];
}
