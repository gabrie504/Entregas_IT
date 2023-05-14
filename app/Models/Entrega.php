<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{

    protected $table = 'entregas';

    protected $fillable = ['fecha_entrega', 'hora_entrega', 'nombre_encargado', 'foto_articulo'];


}