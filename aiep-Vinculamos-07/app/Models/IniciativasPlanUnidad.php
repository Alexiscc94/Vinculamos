<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanUnidad extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_unidad';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_unidad',
        'fecha_creacion'
    ];
}
