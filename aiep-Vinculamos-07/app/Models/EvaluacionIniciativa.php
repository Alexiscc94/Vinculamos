<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionIniciativa extends Model
{
    use HasFactory;

    protected $table = 'viga_evaluacion_iniciativa';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'tipo_evaluacion',
        'visible',
        'fecha_creacion'
    ];
}
