<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamImpactoInterno extends Model
{
    use HasFactory;

    protected $table = 'viga_param_impacto_interno';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
