<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// Modelos
use App\Models\ParticipacionPlan;
use App\Models\ParticipacionPlanTag;
use App\Models\ParticipacionReal;
use App\Models\ParticipacionRealTag;
use App\Models\IniciativasPlan;
use App\Models\Logs;

class ParticipacionController extends Controller
{
    /////////////////////////////////////////////////////////////////////////////
    //                                                                         //
    //                           Participacion TAG                             //
    //                                                                         //
    /////////////////////////////////////////////////////////////////////////////

    // TODO: Buscar Participacion Tag
    public function ListarParticipacionTag() {
        return view('auth.ingresar', [
            'ParticipacionTag' => ParticipacionPlanTag::select('id','id_iniciativa','id_participacion','detalle')->where('visible', 1)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Buscar Participacion Tag x Participacion
    public function ListarParticipacionTagxParticipacion(Request $request) {
        return view('auth.ingresar', [
            'ParticipacionTag' => ParticipacionPlanTag::select('id','id_iniciativa','id_participacion','detalle')->where('id_participacion', $request)->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Actualizar Participacion Tag
    public function ActualizarParticipacionTag(Request $request) {

        $tagUpdate = ParticipacionPlanTag::where(['id_iniciativa' => $request->idiniciativa,"id_participacion" => $request->idParticipation])
                                        ->update(['detalle' => $request->detalle]);
       
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "iniciativas_plan_participacion_tag",
            'id_recurso' => $request->id,
            'descripcion' => "Modificación de ambito con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);
    }

    /////////////////////////////////////////////////////////////////////////////
    //                                                                         //
    //                           Participacion PLANEADA                        //
    //                                                                         //
    /////////////////////////////////////////////////////////////////////////////

    // TODO: Guardar Participacion Plan
    public function GuardarParticipacionPlan(Request $request)
    {
        $request->validate(
            [
                'id_iniciativa' => 'max:11',
                'tipo' => 'required|max:100',
                'tipo2' => 'required|max:100',
                'publico_general' => 'max:11',
                'aplica_sexo' => 'max:100',
                'sexo_masculino' => 'max:11',
                'sexo_femenino' => 'max:11',
                'sexo_otro' => 'max:11',
                'aplica_edad' => 'max:100',
                'edad_ninos' => 'max:11',
                'edad_jovenes' => 'max:11',
                'edad_adultos' => 'max:11',
                'edad_adultos_mayores' => 'max:11',
                'aplica_procedencia' => 'max:100',
                'procedencia_rural' => 'max:11',
                'procedencia_urbano' => 'max:11',
                'aplica_vulnerabilidad' => 'max:100',
                'vulnerabilidad_pueblo' => 'max:11',
                'vulnerabilidad_discapacidad' => 'max:11',
                'vulnerabilidad_pobreza' => 'max:11',
                'aplica_nacionalidad' => 'max:100',
                'nacionalidad_chileno' => 'max:11',
                'nacionalidad_migrante' => 'max:11',
                'nacionalidad_pueblo' => 'max:11',
                'aplica_etnia' => 'max:11',
                'etnia_mapuche' => 'max:11',
                'etnia_otro' => 'max:11',
                'autor' => 'max:100',
                // 'unidad' => 'required'
            ]
        );

        $participacion = ParticipacionPlan::insertGetId([
            'id_iniciativa' => $request->id_iniciativa,
            'tipo' => $request->tipo,
            'tipo2' => $request->tipo2,
            'publico_general' => $request->publico_general,
            'aplica_sexo' => $request->aplica_sexo,
            'sexo_masculino' => $request->sexo_masculino,
            'sexo_femenino' => $request->sexo_femenino,
            'sexo_otro' => $request->sexo_otro,
            'aplica_edad' => $request->aplica_edad,
            'edad_ninos' => $request->edad_ninos,
            'edad_jovenes' => $request->edad_jovenes,
            'edad_adultos' => $request->edad_adultos,
            'edad_adultos_mayores' => $request->edad_adultos_mayores,
            'aplica_procedencia' => $request->aplica_procedencia,
            'procedencia_rural' => $request->procedencia_rural,
            'procedencia_urbano' => $request->procedencia_urbano,
            'aplica_vulnerabilidad' => $request->aplica_vulnerabilidad,
            'vulnerabilidad_pueblo' => $request->vulnerabilidad_pueblo,
            'vulnerabilidad_discapacidad' => $request->vulnerabilidad_discapacidad,
            'vulnerabilidad_pobreza' => $request->vulnerabilidad_pobreza,
            'aplica_nacionalidad' => $request->aplica_nacionalidad,
            'nacionalidad_chileno' => $request->nacionalidad_chileno,
            'nacionalidad_migrante' => $request->nacionalidad_migrante,
            'nacionalidad_pueblo' => $request->nacionalidad_pueblo,
            'aplica_etnia' => $request->aplica_etnia,
            'etnia_mapuche' => $request->etnia_mapuche,
            'etnia_otro' => $request->etnia_otro,
            'autor' => $request->autor,
        ]);

        if (!$participacion) return redirect()->route('admin.listar.usuario')->with('errorParticipaci', 'La participación no se pudo crear, intente más tarde.');
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "participacion_esperada",
            'id_recurso' => $participacion,
            'descripcion' => "Nuevo registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);
        


        return redirect()->route('admin.listar.usuario')->with('exitoParticipacion', 'Participacion ingresada correctamente.');
    }

    // TODO: Eliminar Participacion Plan
    public function EliminarParticipacionPlan(Request $request)
    {
        $partiVerificar = ParticipacionPlan::where(['id' => $request->id, 'id_iniciativa' => $request->id_iniciativa])->first();
        if (!$partiEliminar) return redirect()->route('admin.listar.usuario')->with('errorParticipio', 'La participación planeada no se encuentra registrado en el sistema.'); // Cambiar ruta

        $partiEliminar = ParticipacionPlan::where(['id' => $request->id, 'id_iniciativa' => $request->id_iniciativa])->update(['visible' => -1]);
        if (!$partiEliminar) return redirect()->route('admin.listar.usuario')->with('errorParticipio', 'La participación planeadano se pudo eliminar, intente más tarde.');// Cambiar ruta
       
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "participacion_esperada",
            'id_recurso' => $request->id,
            'descripcion' => "Eliminación de registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);
        
        return redirect()->route('admin.listar.usuario')->with('exitoParticipio', 'La participación planeada fue eliminada correctamente.');// Cambiar ruta
    }

    // TODO: Buscar Participacion Plan x Iniciativa
    public function BuscarParticipacionPlanxIniciativa(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'ParticipacionPlaneada' => ParticipacionPlan::where(['visible' => 1 , 'id_iniciativa' => $request->id_iniciativa])->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Sumar Participacion Plan x Iniciativa
    public function SumarParticipacionPlanxIniciativa(Request $request, $columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa])
        ]);
    }

    // TODO: Sumar Participacion Plan x Iniciativa y Tipo
    public function SumarParticipacionPlanxIniciativaTipo(Request $request, $columna, $tipo)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"tipo" => $tipo])
        ]);
    }

    // TODO: Sumar Publico General Participacion Plan x Iniciativa
    public function SumarPGeneralParticipacionPlanxIniciativa(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum(["publico_general"])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa])
        ]);
    }

    // TODO: Sumar Publico General Participacion Plan x Iniciativa y Tipo2
    public function SumarPGeneralParticipacionPlanxIniciativaTipo2(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum(["publico_general"])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"tipo2" => $request->type2])
        ]);
    }

    // TODO: Sumar Participacion Plan x Iniciativa y Genero
    public function SumarParticipacionPlanxIniciativaGenero(Request $request,$columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"aplica_sexo" => "on"])
        ]);
    }

    // TODO: Sumar Participacion Plan x Iniciativa y Edad
    public function SumarParticipacionPlanxIniciativaEdad(Request $request,$columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"aplica_edad" => "on"])
        ]);
    }

    // TODO: Sumar Participacion Plan x Iniciativa y Procedencia
    public function SumarParticipacionPlanxIniciativaProcedencia(Request $request,$columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionPlan::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"aplica_procedencia" => "on"])
        ]);
    }

    /////////////////////////////////////////////////////////////////////////////
    //                                                                         //
    //                           Participacion REAL                            //
    //                                                                         //
    /////////////////////////////////////////////////////////////////////////////

    // TODO: Guardar Participacion Real
    public function GuardarParticipacionReal(Request $request)
    {
        $request->validate(
            [
                'id_iniciativa' => 'max:11',
                'tipo' => 'required|max:100',
                'tipo2' => 'required|max:100',
                'publico_general' => 'max:11',
                'aplica_sexo' => 'max:100',
                'sexo_masculino' => 'max:11',
                'sexo_femenino' => 'max:11',
                'sexo_otro' => 'max:11',
                'aplica_edad' => 'max:100',
                'edad_ninos' => 'max:11',
                'edad_jovenes' => 'max:11',
                'edad_adultos' => 'max:11',
                'edad_adultos_mayores' => 'max:11',
                'aplica_procedencia' => 'max:100',
                'procedencia_rural' => 'max:11',
                'procedencia_urbano' => 'max:11',
                'aplica_vulnerabilidad' => 'max:100',
                'vulnerabilidad_pueblo' => 'max:11',
                'vulnerabilidad_discapacidad' => 'max:11',
                'vulnerabilidad_pobreza' => 'max:11',
                'aplica_nacionalidad' => 'max:100',
                'nacionalidad_chileno' => 'max:11',
                'nacionalidad_migrante' => 'max:11',
                'nacionalidad_pueblo' => 'max:11',
                'aplica_etnia' => 'max:11',
                'etnia_mapuche' => 'max:11',
                'etnia_otro' => 'max:11',
                'autor' => 'max:100',
                // 'unidad' => 'required'
            ]
        );

        $participacion = ParticipacionReal::insertGetId([
            'id_iniciativa' => $request->id_iniciativa,
            'tipo' => $request->tipo,
            'tipo2' => $request->tipo2,
            'publico_general' => $request->publico_general,
            'aplica_sexo' => $request->aplica_sexo,
            'sexo_masculino' => $request->sexo_masculino,
            'sexo_femenino' => $request->sexo_femenino,
            'sexo_otro' => $request->sexo_otro,
            'aplica_edad' => $request->aplica_edad,
            'edad_ninos' => $request->edad_ninos,
            'edad_jovenes' => $request->edad_jovenes,
            'edad_adultos' => $request->edad_adultos,
            'edad_adultos_mayores' => $request->edad_adultos_mayores,
            'aplica_procedencia' => $request->aplica_procedencia,
            'procedencia_rural' => $request->procedencia_rural,
            'procedencia_urbano' => $request->procedencia_urbano,
            'aplica_vulnerabilidad' => $request->aplica_vulnerabilidad,
            'vulnerabilidad_pueblo' => $request->vulnerabilidad_pueblo,
            'vulnerabilidad_discapacidad' => $request->vulnerabilidad_discapacidad,
            'vulnerabilidad_pobreza' => $request->vulnerabilidad_pobreza,
            'aplica_nacionalidad' => $request->aplica_nacionalidad,
            'nacionalidad_chileno' => $request->nacionalidad_chileno,
            'nacionalidad_migrante' => $request->nacionalidad_migrante,
            'nacionalidad_pueblo' => $request->nacionalidad_pueblo,
            'aplica_etnia' => $request->aplica_etnia,
            'etnia_mapuche' => $request->etnia_mapuche,
            'etnia_otro' => $request->etnia_otro,
            'autor' => $request->autor,
        ]);

        if (!$participacion) return redirect()->route('admin.listar.usuario')->with('errorParticipaci', 'La participación no se pudo crear, intente más tarde.');
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "participacion_real",
            'id_recurso' => $participacion,
            'descripcion' => "Nuevo registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);
        


        return redirect()->route('admin.listar.usuario')->with('exitoParticipacion', 'Participacion ingresada correctamente.');
    }

    // TODO: Eliminar Participacion Real
    public function EliminarParticipacionReal(Request $request)
    {
        $partiVerificar = ParticipacionReal::where(['id' => $request->id, 'id_iniciativa' => $request->id_iniciativa])->first();
        if (!$partiEliminar) return redirect()->route('admin.listar.usuario')->with('errorParticipio', 'La participación real no se encuentra registrado en el sistema.'); // Cambiar ruta

        $partiEliminar = ParticipacionReal::where(['id' => $request->id, 'id_iniciativa' => $request->id_iniciativa])->update(['visible' => -1]);
        if (!$partiEliminar) return redirect()->route('admin.listar.usuario')->with('errorParticipio', 'La participación real se pudo eliminar, intente más tarde.');// Cambiar ruta
       
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "participacion_real",
            'id_recurso' => $request->id,
            'descripcion' => "Eliminación de registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);
        
        return redirect()->route('admin.listar.usuario')->with('exitoParticipio', 'La participación real fue eliminada correctamente.');// Cambiar ruta
    }

    // TODO: Buscar Participacion Real x Iniciativa
    public function BuscarParticipacionRealxIniciativa(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'ParticipacionReal' => ParticipacionReal::where(['visible' => 1 , 'id_iniciativa' => $request->id_iniciativa])->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Sumar Participacion Real x Iniciativa
    public function SumarParticipacionRealxIniciativa(Request $request, $columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa])
        ]);
    }

    // TODO: Sumar Participacion Real x Iniciativa y Tipo
    public function SumarParticipacionRealxIniciativaTipo(Request $request, $columna, $tipo)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"tipo" => $tipo])
        ]);
    }

    // TODO: Sumar Publico General Participacion Real x Iniciativa 
    public function SumarPGeneralParticipacionRealxIniciativa(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum(["publico_general"])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa])
        ]);
    }

    // TODO: Sumar Publico General Participacion Real x Iniciativa y Tipo2
    public function SumarPGeneralParticipacionRealxIniciativaTipo2(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum(["publico_general"])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"tipo2" => $request->type2])
        ]);
    }

    // TODO: Sumar Participacion Real x Iniciativa y Genero
    public function SumarParticipacionRealxIniciativaGenero(Request $request,$columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"aplica_sexo" => "on"])
        ]);
    }

    // TODO: Sumar Participacion Real x Iniciativa y Edad
    public function SumarParticipacionPRealxIniciativaEdad(Request $request,$columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"aplica_edad" => "on"])
        ]);
    }

    // TODO: Sumar Participacion Real x Iniciativa y Procedencia
    public function SumarParticipacionRealxIniciativaProcedencia(Request $request,$columna)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Total' => ParticipacionReal::sum([$columna])->where(['visible' => 1, 'id_iniciativa' => $request->id_iniciativa,"aplica_procedencia" => "on"])
        ]);
    }
}
