<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributoMecanismo extends Model
{
    use HasFactory;

    protected $table = 'viga_atributo_mecanismo';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'puntaje',
        'visible',
        'fecha_creacion'
    ];
}
