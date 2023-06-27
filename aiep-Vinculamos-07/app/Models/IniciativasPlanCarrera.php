<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanCarrera extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_carrera';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_carrera',
        'fecha_creacion'
    ];
}
