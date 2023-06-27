<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanRegion extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_georegion';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_region',
        'fecha_creacion'
    ];
}
