<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionConocimiento extends Model
{
    use HasFactory;

    protected $table = 'viga_evaluacion_conocimiento_ori_pregunta';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'tipo_evaluador',
        'texto',
        'orden_visible',
    ];
}
