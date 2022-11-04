<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='ventas';
    protected $primaryKey='id';


    protected $fillable =[
        'id_cliente',
        'fecha',
        'impuesto',
        'total',
        'status',
        
    ];
}
