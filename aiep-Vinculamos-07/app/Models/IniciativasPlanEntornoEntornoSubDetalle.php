<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanEntornoEntornoSubDetalle extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_entorno_entornosub_detalle';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_entorno',
        'id_entorno_sub',
        'tag',
        'autor',
        'fecha_creacion'
    ];
}
