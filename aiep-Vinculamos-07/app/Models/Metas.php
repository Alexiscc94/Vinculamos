<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{
    use HasFactory;

    protected $table = 'viga_metas';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'concepto_pertinente',
        'factor',
        'id_objetivo',
        'visible',
        'fecha_creacion'
    ];
}
