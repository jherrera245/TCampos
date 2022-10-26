<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table='clientes';

    protected $primaryKey='id';

    protected $fillable = [
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
