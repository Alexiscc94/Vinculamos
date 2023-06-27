<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $table = 'viga_carreras';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'director',
        'id_facultad',
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
