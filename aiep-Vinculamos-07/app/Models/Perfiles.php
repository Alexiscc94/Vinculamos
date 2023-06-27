<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;

    protected $table = 'viga_perfiles';

    public $timestamps = false;

    protected $fillable = [
        'id_perfil ',
        'nombre',
        'institucion',
        'permiso_usuarios',
        'permiso_objetivos',
        'permiso_iniciativas',
        'permiso_desafios',
        'permiso_estadisticas',
        'permiso_parametros'
    ];
}
