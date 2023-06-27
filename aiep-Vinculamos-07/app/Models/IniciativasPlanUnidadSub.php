<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanUnidadSub extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_unidad_sub';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_unidad_sub',
        'fecha_creacion'
    ];
}
