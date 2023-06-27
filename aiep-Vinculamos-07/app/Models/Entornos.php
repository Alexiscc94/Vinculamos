<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entornos extends Model
{
    use HasFactory;

    protected $table = 'viga_entornos_significativos';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'fecha_creacion'
    ];
}
