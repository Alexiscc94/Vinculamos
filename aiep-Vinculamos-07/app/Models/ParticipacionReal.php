<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipacionReal extends Model
{
    use HasFactory;

    protected $table = 'viga_participacion_real';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'tipo',
        'publico_general',
        'aplica_sexo',
        'sexo_masculino',
        'sexo_femenino',
        'sexo_otro',
        'aplica_edad',
        'edad_ninos',
        'edad_jovenes',
        'edad_adultos',
        'edad_adultos_mayores',
        'aplica_procedencia',
        'procedencia_rural',
        'procedencia_urbano',
        'aplica_vulnerabilidad',
        'vulnerabilidad_pueblo',
        'vulnerabilidad_discapacidad',
        'vulnerabilidad_pobreza',
        'aplica_nacionalidad',
        'nacionalidad_chileno',
        'nacionalidad_migrante',
        'nacionalidad_pueblo',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
