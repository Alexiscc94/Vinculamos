<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    use HasFactory;

    protected $table = 'viga_sedes';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'director',
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
