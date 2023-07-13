<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    use HasFactory;

    protected $table = 'detalleprestamos';

    protected $fillable = ['id_prestamo','id_articulo', 'descripcion_articulo'];

 
}
