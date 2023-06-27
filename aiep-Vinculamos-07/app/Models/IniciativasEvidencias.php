<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasEvidencias extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_evidencias';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'archivo',
        'id_iniciativa',
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
