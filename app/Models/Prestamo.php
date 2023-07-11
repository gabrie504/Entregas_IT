<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;
    protected $table = 'prestamos';

    protected $fillable = [
        'fecha_entrega',
        'hora_entrega',
        'nombre_encargado',
        'foto_articulo',
    ];
}
