<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'viga_geo_comuna';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_region',
        'nombre'
    ];
}
