<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanPais extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_geopais';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_pais',
        'fecha_creacion'
    ];
}
