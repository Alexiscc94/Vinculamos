<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionRespuestaDetalle extends Model
{
    use HasFactory;

    protected $table = 'viga_evaluacion_detalle_respuesta';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_evaluacion',
        'correo_evaluador',
        'clave',
        'valor',
        'autor',
        'fecha_creacion'
    ];
}
