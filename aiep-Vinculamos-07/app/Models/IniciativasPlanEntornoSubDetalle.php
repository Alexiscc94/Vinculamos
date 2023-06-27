<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanEntornoSubDetalle extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_entornosubdetalle';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_entorno',
        'id_entornosub',
        'detalle',
        'fecha_creacion'
    ];
}
