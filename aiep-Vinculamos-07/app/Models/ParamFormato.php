<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamFormato extends Model
{
    use HasFactory;

    protected $table = 'viga_param_formato_implementacion';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'visible',
        'autor',
        'fecha_creacion'
    ];
}
