<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionEvaluadores extends Model
{
    use HasFactory;

    protected $table = 'viga_evaluacion_evaluadores';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_evaluacion',
        'tipo_evaluacion',
        'nombre',
        'correo_electronico',
        'estado',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
