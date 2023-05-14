<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePersona extends Model
{
    use HasFactory;

    protected $fillable = ['id_entrega', 'id_persona', 'firma_encargado'];
}
