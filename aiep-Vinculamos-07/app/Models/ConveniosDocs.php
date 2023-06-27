<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConveniosDocs extends Model
{
    use HasFactory;

    protected $table = 'viga_convenios_docs';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'archivo',
        // claves foraneas
        'id_convenio',
        // elementos
        'visible',
        'institucion',
        'autor',
        'fecha_creacion'
    ];
}
