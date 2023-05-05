<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonsaDetalles extends Model
{
    use HasFactory;

    protected $table = 'detallepersonas';
    
    protected $filable = ['id_entrega' , 'id_persona' , 'firma_encargado'];
}
