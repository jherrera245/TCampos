<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    //tabla
    protected $tabla = "proveedores";

    //filas
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'dui',
        'direccion',
        'telefono',
        'email',
        'status',
    ];
}
