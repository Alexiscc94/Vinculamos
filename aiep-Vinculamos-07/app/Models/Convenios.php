<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{
    use HasFactory;

    protected $table = 'viga_convenios';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
