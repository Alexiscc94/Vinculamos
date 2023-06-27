<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamEstadoCompletitud extends Model
{
    use HasFactory;

    protected $table = 'viga_param_estado_completitud';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
