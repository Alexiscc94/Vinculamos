<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipacionRealTag extends Model
{
    use HasFactory;

    protected $table = 'viga_participacion_real_tag';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_participacion',
        'detalle',
        'visible',
        'fecha_creacion'
    ];
}
