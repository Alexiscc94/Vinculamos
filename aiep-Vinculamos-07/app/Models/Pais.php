<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'viga_geo_pais';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre'
    ];
}
