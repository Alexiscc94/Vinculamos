<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanFacultad extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_facultad';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_facultad',
        'fecha_creacion'
    ];
}
