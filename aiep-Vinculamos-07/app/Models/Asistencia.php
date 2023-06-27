<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'viga_lista_asistencia';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'tipo',
        'rut',
        'nombre',
        'correo_electronico',
        'telefono',
        'estado',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
