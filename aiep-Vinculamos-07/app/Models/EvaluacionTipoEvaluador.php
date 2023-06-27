<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionTipoEvaluador extends Model
{
    use HasFactory;

    protected $table = 'viga_evaluacion_tipo_evaluador';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible'
    ];
}
