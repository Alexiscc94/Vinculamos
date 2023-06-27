<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanResultado extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_resultado';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'tipo',
        'cantidad',
        'resultado',
        'autor',
        'visible',
        'fecha_creacion'
    ];
}
