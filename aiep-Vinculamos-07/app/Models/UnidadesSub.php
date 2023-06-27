<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesSub extends Model
{
    use HasFactory;

    protected $table = 'viga_unidades_subs';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'director',
        'id_unidad',
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
