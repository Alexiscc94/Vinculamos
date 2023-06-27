<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entornos extends Model
{
    use HasFactory;

    protected $table = 'viga_entornos_significativos_sub';

    public $timestamps = false;

    protected $fillable = [
        'id',
        // clave forranea
        'id_entorno',
        'nombre',
        'visible',
        'fecha_creacion'
    ];
}
