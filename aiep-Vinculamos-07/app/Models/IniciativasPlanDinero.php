<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanDinero extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_recursodinero';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'fuente',
        'tipo',
        'valorizacion',
        'autor',
        'visible',
        'fecha_creacion'
    ];
}
