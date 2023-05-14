<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaRecibe extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = ['nombre_persona' , 'firma_persona'];

    public $timestamps = false;
}
