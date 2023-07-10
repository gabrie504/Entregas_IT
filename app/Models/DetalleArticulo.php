<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleArticulo extends Model
{
    use HasFactory;

    protected $table = 'detallearticulos';

    protected $fillable = ['id_entrega','id_articulo', 'descripcion_articulo' ];

    public $timestamps = false;
}
