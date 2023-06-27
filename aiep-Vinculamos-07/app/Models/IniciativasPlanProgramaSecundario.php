<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanProgramaSecundario extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_programasecundario';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_programa',
        'fecha_creacion'
    ];
}
