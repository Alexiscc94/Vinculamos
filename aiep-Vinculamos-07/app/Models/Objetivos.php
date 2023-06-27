<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivos extends Model
{
    use HasFactory;

    protected $table = 'viga_objetivos';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'nombre_largo',
        'descripcion',
        'descripcion_larga',
        'id_ambito',
        'visible',
        'fecha_creacion'
    ];
}
