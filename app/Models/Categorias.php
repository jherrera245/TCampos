<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'categorias';

    //columnas
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'status'
    ];
}
