<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanEntornoDetalle extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_entornodetalle';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'detalle',
        'fecha_creacion'
    ];
}
