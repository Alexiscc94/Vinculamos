<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamRecursoInfraestructura extends Model
{
    use HasFactory;

    protected $table = 'viga_param_recurso_infraestructura';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'puntaje',
        'descripcion',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
