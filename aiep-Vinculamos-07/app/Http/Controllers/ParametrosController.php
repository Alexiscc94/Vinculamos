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

    // TODO:Seccion para CRUD: Escuelas
    public function ListarEscuelas() {
        return view('auth.ingresar', [
            'Escuelas' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    public function EliminarEscuela(Request $request)
    {
        $EliminarEscuela = Escuelas::where('id', $request->id)->delete();
        if (!$EliminarEscuela) return redirect()->back()->with('errorEscuela', 'Ocurrió un error al eliminar la escuela.');
        return redirect()->route('admin.entornos.listar')->with('exitoEscuela', 'La escuela fue eliminado correctamente.');
    }

    // TODO:Seccion para CRUD: Sedes
    public function ListarSedes() {
        return view('auth.ingresar', [
            'cargos' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    public function EliminarSedes(Request $request) {
        $EliminarSedes = Sedes::where('id', $request->id)->delete();
        if (!$EliminarSedes) return redirect()->back()->with('errorSede', 'Ocurrió un error al eliminar la sede.');
        return redirect()->route('admin.entornos.listar')->with('exitoSede', 'La sede fue eliminado correctamente.');
    }

    // TODO:Seccion para CRUD: AmbitosContribucion
    public function ListarAmbitos() {
        return view('auth.ingresar', [
            'cargos' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Programas
    public function ListarProgramas() {
        return view('auth.ingresar', [
            'cargos' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    public function CrearProgramas(Request $request) {
        return view('auth.ingresar', [
            'cargos' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    public function EditarProgramas(Request $request, $id_programa) {
        $request->validate(
            [
                'nombre' => 'required|max:100|min:1',
                'descripcion' => 'required|in:S,N',
                'director' => 'required',
            ],
            [
                'nombre.required' => 'Es necesario que se le asigne un nombre al entorno.',
                'nombre.max' => 'El nombre del entorno no debe superar los 100 carácteres.',
                'nombre.min' => 'El nombre del entorno es demasiado corto.',
                'descripcion.required' => 'Estado del entorno es requerido.',
                'descripcion.in' => 'Estado del entorno debe ser activo o inactivo.',
                'director.required' => 'Es necesario que se seleccione un icono'
            ]
        );

        $VerificarPrograma = Entornos::where('id', $id_programa)->first();
        if (!$entoVerificar)
            return redirect()->back()->with('errorPrograma', 'El programa no se encuentra registrado.');

        $ActualizarPrograma = Entornos::where('id', $id_programa)->update([
            'ento_nombre' => $request->ento_nombre,
            'ento_ruta_icono' => $request->ento_ruta_icono,
            'ento_actualizado' => Carbon::now()->format('Y-m-d H:i:s'),
            'ento_vigente' => $request->ento_vigencia,
            'ento_rut_mod' => Session::get('admin')->usua_rut,
            'ento_rol_mod' => Session::get('admin')->rous_codigo,
        ]);
        if (!$ActualizarPrograma) return redirect()->back()->with('errorPrograma', 'Ocurrió un error al actualizar el programa, por favor intente más tarde, si el error persiste por favor comuníquese con su supervisor o con el administrador del sistema.');
        return redirect()->route('admin.entornos.listar')->with('exitoPrograma', 'El programa se actualizó correctamente.');
    }

    public function EliminarProgramas(Request $request) {
        $EliminarPrograma = Programa::where('id', $request->id)->delete();
        if (!$EliminarPrograma) return redirect()->back()->with('errorPrograma', 'Ocurrió un error al eliminar el programa.');
        return redirect()->route('admin.entornos.listar')->with('exitoPrograma', 'El programa fue eliminado correctamente.');
    }

    // TODO:Seccion para CRUD: Convenios
    public function ListarConvenios() {
        return view('auth.ingresar', [
            'cargos' => Convenios::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    public function EliminarConvenios(Request $request) {
        $EliminarConvenio = Convenios::where('id', $request->id)->delete();
        if (!$EliminarConvenio) return redirect()->back()->with('errorConvenio', 'Ocurrió un error al eliminar el convenio.');
        return redirect()->route('admin.entornos.listar')->with('exitoConvenio', 'El convenio fue eliminado correctamente.');
    }

    // TODO:Seccion para CRUD: Cargo Encargado
    public function ListarCargo() {
        return view('auth.ingresar', [
            'cargos' => ParamCargoEncargado::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Estado Completitud
    public function ListarEstadoCompletitud() {
        return view('auth.ingresar', [
            'e_completitud' => ParamEstadoCompletitud::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Estado de Ejecucion
    public function ListarEstadoEjecucion() {
        return view('auth.ingresar', [
            'e_ejecucion' => ParamEstadoEjecucion::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Formatos
    public function ListarFormato() {
        return view('auth.ingresar', [
            'formato' => ParamFormato::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Impacto Externo
    public function ListarImpactoExterno() {
        return view('auth.ingresar', [
            'impacto_ex' => ParamImpactoExterno::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Impacto Interno
    public function ListarImpactoInterno() {
        return view('auth.ingresar', [
            'impacto_in' => ParamImpactoInterno::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    public function ListarImpactoInternoxIniciativaPlan(Request $request) {
        return view('auth.ingresar', [
            'impacto_in' => ParamImpactoInterno::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO:Seccion para CRUD: Tipo de Participante
    public function ListarTipoParticipante() {
        return view('auth.ingresar', [
            'tipo_parti' => ParamParticipantes::where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }
    // TODO:Seccion para CRUD: Recursos Humanos
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

    // TODO:Seccion para CRUD: Infraestructura
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
