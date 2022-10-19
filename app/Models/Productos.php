<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'productos';

    //columnas
    protected $fillable = [
        'id',
        'nombre',
        'codigo',
        'stock',
        'descripcion',
        'imagen',
        'id_categoria',
        'id_marca',
        'status',
    ];
}
