<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// Modelos
use App\Models\Unidades;
use App\Models\UnidadesSub;
use App\Models\Logs;
use App\Models\IniciativaPlan;
use App\Models\IniciativaPlanUnidad;

class ParametrosController extends Controller
{
    // TODO: Guardado
    public function GuardarUnidad(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'max:100',
                'descripcion' => 'required|max:100',
                'director' => 'required|max:100',
                'institucion' => 'max:100',
                'autor' => 'max:100'
            ]
        );

        $unidad = Unidades::insertGetId([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'director' => $request->director,
            'institucion' => $request->institucion,
            'autor' => $request->autor
        ]);

        if (!$unidad) return redirect()->route('admin.listar.usuario')->with('errorUnidad', 'La unidad no se pudo crear, intente más tarde.');
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "unidades",
            'id_recurso' => $unidad,
            'descripcion' => "Nuevo registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('admin.listar.usuario')->with('exitoUnidad', 'Unidad ingresada correctamente.'); // cambio de ruta
    }

    // TODO: Actuaizar
    public function ActualizarUnidad(Request $request)
    {
        $unidadUpdate = Unidades::where(['id' => $request->id])
                                ->update(['nombre' => $request->nombre, 'descripcion' => $request->descripcion, 'director' => $request->director]);

        if (!$unidad) return redirect()->route('admin.listar.usuario')->with('errorUnidad', 'La unidad no se pudo actualizar, intente más tarde.');
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "unidades",
            'id_recurso' => $request->id,
            'descripcion' => "Modificación en registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('admin.listar.usuario')->with('exitoUnidad', 'Unidad actualizada correctamente.'); // cambio de ruta
    }

    // TODO: Eliminar
    public function EliminarUnidad(Request $request)
    {
        $unidadUpdate = Unidades::where(['id' => $request->id])->update(['visible' => -1]);
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "unidades",
            'id_recurso' => $request->id,
            'descripcion' => "Eliminación de registro con valores {id => $request->id, visible => -1}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('admin.listar.usuario')->with('exitoUnidad', 'Unidad eliminada correctamente.'); // cambio de ruta
    }

    // TODO: Buscar 
    public function BuscarUnidad()
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Unidad' => Unidades::where(['visible' => 1])->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Buscar por ID
    public function BuscarUnidadID(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Unidad' => Unidades::where(['visible' => 1 ,'id' => $request->id])->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Buscar por Institucion
    public function BuscarUnidadInstitu(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Unidad' => Unidades::where(['visible' => 1,'institucion' => $request->institucion])->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Buscar por ID e Institucion
    public function BuscarUnidadIDInstitu(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Unidad' => Unidades::where(['visible' => 1, 'id' => $request->id, 'institucion' => $request->institucion])->orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Buscar por Iniciativa Plan
    public function BuscarUnidadIniciativaPlan(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Unidad' => DB::table('viga_unidades')
                            ->join('viga_iniciativas_plan_unidad','viga_iniciativas_plan_unidad.id_unidad','=','viga_unidades.id')
                            ->select('viga_unidades.id','viga_unidades.nombre')
                            ->where('viga_iniciativas_plan_unidad.id_iniciativa',$request->iniciativa)
                            ->distinct() 
                            ->get()
        ]);
    }

    // TODO: Contar Unidad por Institucion 
    public function ContarUnidadInstitucion(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Conteo' => Unidades::count('id')->where(['visible'=>1,'institucion'=>$request->institucion])
        ]);
    }

    // TODO: Contar Unidad por Institucion x Grupo
    public function ContarUnidadInstitucionxGrupo(Request $request)
    {
        return view('auth.ingresar', [
            'Conteo' => DB::table('viga_unidades')
                ->join('viga_iniciativas_plan_unidad', 'viga_iniciativas_plan_unidad.id_unidad', '=', 'viga_unidades.id')
                ->select('viga_unidades.id', 'viga_unidades.nombre', DB::raw('count(viga_iniciativas_plan_unidad.id) as iniciativas'))
                ->whereIn('viga_iniciativas_plan_unidad.id_iniciativa', $request->iniciativa)
                ->groupBy('viga_unidades.id', 'viga_unidades.nombre')
                ->orderBy('iniciativas', 'desc')
                ->distinct()
                ->get()
        ]);
    }

    // TODO: Actualizar Unidad x Iniciativa Plan
    //////////////////////////////////////////////////////////////////////////////////      
    //                      DUDA, nose si esté vien el update                       //
    //////////////////////////////////////////////////////////////////////////////////
    public function ActualizarUnidadxIniciativaPlan(Request $request)
    {
        $unidadUpdate = IniciativasPlanUnidad::where(['id_iniciativa' => $request->iniciativa])
                                            ->update(['id_unidad' => $request->unidad]);

        if (!$unidad) return redirect()->route('admin.listar.usuario')->with('errorUnidad', 'La unidad no se pudo actualizar, intente más tarde.');
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "iniciativa_plan_unidad",
            'id_recurso' => $request->id,
            'descripcion' => "Modificación en registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('admin.listar.usuario')->with('exitoUnidad', 'Unidad actualizada correctamente.'); 
    }

    // TODO: Buscar Unidad x Iniciativa Real
    //////////////////////////////////////////////////////////////////////////////////      
    //                      DUDA, nose si esté vien el update                       //
    //                      INICIATIVA "REAL", nu hay datos :c                      //
    //////////////////////////////////////////////////////////////////////////////////
    public function BuscarUnidadIniciativaReal(Request $request)
    {
        return view('auth.ingresar', [ // Cambiar ruta
            'Unidad' => DB::table('viga_unidades')
                            ->join('viga_iniciativas_real_unidad','viga_iniciativas_real_unidad.id_unidad','=','viga_unidades.id')
                            ->select('viga_unidades.id','viga_unidades.nombre')
                            ->where('viga_iniciativas_real_unidad.id_iniciativa',$request->iniciativa)
                            ->distinct()
                            ->get()
        ]);
    }

    // TODO: Actualizar Unidad x Iniciativa Real
    public function ActualizarUnidadxIniciativaReal(Request $request)
    {
        $unidadUpdate = IniciativasRealUnidad::where(['id_iniciativa' => $request->iniciativa])
                                            ->update(['id_unidad' => $request->unidad]);

        if (!$unidad) return redirect()->route('admin.listar.usuario')->with('errorUnidad', 'La unidad no se pudo actualizar, intente más tarde.');
        $registro = Logs::create([
            'autor' => "admin",
            'recurso' => "iniciativa_real_unidad",
            'id_recurso' => $request->id,
            'descripcion' => "Modificación en registro con valores {$request}",
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('admin.listar.usuario')->with('exitoUnidad', 'Unidad actualizada correctamente.'); 
    }
}
