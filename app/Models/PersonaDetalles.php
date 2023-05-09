<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaDetalles extends Model
{
    use HasFactory;

    protected $table = 'detallepersonas';
    
    protected $fillable = ['id_entrega' , 'id_persona' , 'firma_encargado'];

    public $timestamps = false;
}
