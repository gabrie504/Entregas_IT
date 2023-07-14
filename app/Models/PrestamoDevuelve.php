<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestamoDevuelve extends Model
{
    use HasFactory;

    protected $table = 'prestamo_devolucion';

    protected $filable =[
        'firma_devolucion',
        'nombre_devuelve',
        'foto_devolucion',
        'encargado_recibe',
        'nota_devuelve',
        'id_prestamo'
    ];
}
