<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;

    //tabla
    protected $table ='marcas';

    //columnas
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'status'
    ];
}
