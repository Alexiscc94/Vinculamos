<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// Modelos
use App\Models\IniciativasEvidencias;
use App\Models\IniciativasPlan;
use App\Models\IniciativasPlanCarrera;
use App\Models\IniciativasPlanConvenio;
use App\Models\IniciativasPlanDinero;
use App\Models\IniciativasPlanEntorno;
use App\Models\IniciativasPlanEntornoDetalle;
use App\Models\IniciativasPlanEntornoEntornoSubDetalle;
use App\Models\IniciativasPlanEntornoSub;
use App\Models\IniciativasPlanEntornoSubDetalle;
use App\Models\IniciativasPlanFacultad;
use App\Models\IniciativasPlanImpacto;
use App\Models\IniciativasPlanImpactoExterno;
use App\Models\IniciativasPlanImpactoInterno;
use App\Models\IniciativasPlanInfraestructura;
use App\Models\IniciativasPlanODS;
use App\Models\IniciativasPlanPais;
use App\Models\IniciativasPlanRegion;
use App\Models\IniciativasPlanComuna;
use App\Models\IniciativasPlanPrograma;
use App\Models\IniciativasPlanProgramaSecundario;
use App\Models\IniciativasPlanRecursoHumano;
use App\Models\IniciativasPlanResultado;
use App\Models\IniciativasPlanSede;
use App\Models\IniciativasPlanUnidad;
use App\Models\IniciativasPlanUnidadSub;
use App\Models\Carreras;
use App\Models\Convenios;
use App\Models\Comuna;
use App\Models\Entornos;
use App\Models\EntornosDetalle;
use App\Models\Facultades;
use App\Models\Metas;
use App\Models\Objetivos;
use App\Models\Programas;
use App\Models\Region;
use App\Models\Pais;
use App\Models\Sedes;
use App\Models\Unidades;
use App\Models\UnidadesSub;
use App\Models\Usuarios; 

class PlanIniciativaController extends Controller
{
    //
}
