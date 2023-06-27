<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributoFrecuencia extends Model
{
    use HasFactory;

    protected $table = 'viga_atributo_frecuencia';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'puntaje',
        'visible',
        'fecha_creacion'
    ];
}
