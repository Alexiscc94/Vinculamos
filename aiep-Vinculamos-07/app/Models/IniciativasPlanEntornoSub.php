<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanEntornoSub extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_entornosub';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_entornosub',
        'fecha_creacion'
    ];
}
