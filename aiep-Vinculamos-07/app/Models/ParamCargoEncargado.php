<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamCargoEncargado extends Model
{
    use HasFactory;

    protected $table = 'viga_param_cargo_encargado';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
