<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanInfraestructura extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_recursoinfraestructura';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'fuente',
        'tipo',
        'cantidad',
        'valorizacion',
        'autor',
        'visible',
        'fecha_creacion'
    ];
}
