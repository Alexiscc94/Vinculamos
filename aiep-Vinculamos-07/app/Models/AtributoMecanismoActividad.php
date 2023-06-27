<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributoMecanismoActividad extends Model
{
    use HasFactory;

    protected $table = 'viga_atributo_mecanismo_actividad';

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
