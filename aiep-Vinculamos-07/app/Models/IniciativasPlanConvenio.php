<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanConvenio extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_convenio';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_convenio',
        'fecha_creacion'
    ];
}
