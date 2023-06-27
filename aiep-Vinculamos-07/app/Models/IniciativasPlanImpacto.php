<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanImpacto extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_impacto';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'tipo',
        'cantidad',
        'impacto',
        'autor',
        'visible',
        'fecha_creacion'
    ];
}
