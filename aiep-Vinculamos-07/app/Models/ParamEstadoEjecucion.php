<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamEstadoEjecucion extends Model
{
    use HasFactory;

    protected $table = 'viga_param_estado_ejecucion';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
