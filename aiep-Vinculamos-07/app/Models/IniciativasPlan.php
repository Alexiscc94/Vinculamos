<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlan extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'responsable',
        'responsable_cargo',
        'formato_implementacion',
        'objetivo',
        'descripcion',
        'id_mecanismo',
        'id_actividad',
        'id_frecuencia',
        'estado',
        'estado_ejecucion',
        'estado_completitud',
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
