<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanComuna extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_geocomuna';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_comuna',
        'fecha_creacion'
    ];
}
