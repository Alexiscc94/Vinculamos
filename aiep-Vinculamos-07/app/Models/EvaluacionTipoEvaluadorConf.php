<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionTipoEvaluadorConfig extends Model
{
    use HasFactory;

    protected $table = 'viga_evaluacion_tipo_evaluador_config';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'tipo_evaluador',
        'clave',
        'orden_visible'
    ];
}
