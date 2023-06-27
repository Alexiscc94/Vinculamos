<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanImpactoInterno extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_impactointerno';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_impacto',
        'fecha_creacion'
    ];
}
