<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonsaRecibe extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $filable = ['nombre_persona',];
}
