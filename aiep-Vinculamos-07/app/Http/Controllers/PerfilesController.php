<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// Modelos
use App\Models\Perfiles;



class AutenticacionController extends Controller
{
    // TODO: Listar Perfiles
    public function ListarPerfiles() {
        return view('auth.ingresar', [
            'tipo_parti' => Perfiles::orderBy('id', 'asc')->get()
        ]);
    }

    // TODO: Listar Perfiles x Institucion
    public function ListarPerfilesxInstitucion(Request $request) {
        return view('auth.ingresar', [
            'tipo_parti' => Perfiles::where('institucion', $request->institucion)->orderBy('id', 'asc')->get()
        ]);
    }
}
