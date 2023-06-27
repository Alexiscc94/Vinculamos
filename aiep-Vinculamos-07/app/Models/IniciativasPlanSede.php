<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanSede extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_sede';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_sede',
        'fecha_creacion'
    ];
}
