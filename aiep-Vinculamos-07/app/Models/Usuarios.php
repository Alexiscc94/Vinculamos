<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'viga_usuarios';

    public $timestamps = false;

    protected $fillable = [
        'nombre_usuario',
        'nombre',
        'apellido',
        'correo_electronico',
        'telefono',
        'contrasenia',
        'estado',
        'visible',
        'id_perfil',
        'fecha_creacion'
    ];
}
