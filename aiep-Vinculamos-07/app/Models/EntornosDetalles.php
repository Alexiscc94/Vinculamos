<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntornosDetalle extends Model
{
    use HasFactory;

    protected $table = 'viga_entornos_significativos_detalle';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'fecha_creacion'
    ];
}
