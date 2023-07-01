<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// Modelos
use App\Models\ParamCargoEncargado;
use App\Models\ParamEstadoCompletitud;
use App\Models\ParamEstadoEjecucion;
use App\Models\ParamFormato;
use App\Models\ParamImpactoExterno;
use App\Models\ParamImpactoInterno;
use App\Models\ParamParticipantes;
use App\Models\ParamRecursoHumano;
use App\Models\ParamRecursoInfraestructura;

class ParametrosController extends Controller
{
    // Listar Elementos
    public function ListarCargo() {
        return view('auth.ingresar', [
            'cargos' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarEstadoCompletitud() {
        return view('auth.ingresar', [
            'e_completitud' => ParamEstadoCompletitud::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarEstadoEjecucion() {
        return view('auth.ingresar', [
            'e_ejecucion' => ParamEstadoEjecucion::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarFormato() {
        return view('auth.ingresar', [
            'formato' => ParamFormato::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarImpactoExterno() {
        return view('auth.ingresar', [
            'impacto_ex' => ParamImpactoExterno::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarImpactoInterno() {
        return view('auth.ingresar', [
            'impacto_in' => ParamImpactoInterno::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarTipoParticipante() {
        return view('auth.ingresar', [
            'tipo_parti' => ParamParticipantes::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    // Recursos Humanos -------------------------------------
    public function ListarRecursosHumanos() {
        return view('auth.ingresar', [
            'RRHH' => ParamRecursoHumano::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarRecursosHumanosxNombre(Request $request) {
        return view('auth.ingresar', [
            'RRHH' => ParamRecursoHumano::where('nombre', $request)->orderBy('id', 'asc')->get()
        ]);
    }

    // Recursos Infraestructura -------------------------------------
    public function ListarRecursosInfra() {
        return view('auth.ingresar', [
            'recursos_infra' => ParamRecursoInfraestructura::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    public function ListarRecursosInfraxNombre(Request $request) {
        return view('auth.ingresar', [
            'recursos_infra' => ParamRecursoInfraestructura::where('nombre', $request)->orderBy('id', 'asc')->get()
        ]);
    }

}
