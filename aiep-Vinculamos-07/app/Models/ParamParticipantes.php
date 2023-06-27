<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamParticipantes extends Model
{
    use HasFactory;

    protected $table = 'viga_param_participantes';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'tipo',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
