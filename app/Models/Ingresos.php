<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'ingresos';

    //columnas
    protected $fillable = [
        'id',
        'id_proveedor',
        'codio_factura',
        'fecha',
        'impuesto',
        'status'
    ];
}
