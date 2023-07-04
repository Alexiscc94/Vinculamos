<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// Modelos
use App\Models\Usuarios;
use App\Models\Unidades;



class AutenticacionController extends Controller
{
    // TODO: Retorno a Login
    public function ingresar() {
        return view('auth.ingresar');
    }

    // TODO: Redireccion a registrar un nuevo Usuario
    public function registrar() {
        // $roles = DB::table('roles_usuarios')->select('rous_codigo','rous_nombre')->limit(3)->orderBy('rous_codigo')->get();
        // $unidades = Unidades::all();
        return view('auth.registrar');
    }

    // TODO: Validar Ingreso
    public function validarIngreso(Request $request) {
        $request->validate(
            [
                'nombre_usuario' => 'required|regex:/(^[0-9]{7,8}-[0-9kK]{1}$)/i',
                'clave' => 'required',
                //'rol' => 'required',
            ],
            [
                'nombre_usuario.required' => 'El nombre_usuario es requerido.',
                //'name_user.regex' => 'El formato del nombre_usuario debe ser 12345678-9.',
                'clave.required' => 'La contraseña es requerida.',
                //'rol.required' => 'El rol de usuario es requerido.'
            ]
        );

        $usuario = Usuarios::where(['nombre_usuario' => $request->nombre_usuario])->first();
        //$rol = RolesUsuarios::select('rous_nombre')->where('rous_codigo', $request->rol)->first()->rous_nombre;
        //                                             'errorRut'   'El usuario no tiene acceso al sistema con el rol de '.$rol.'.'
        if (!$usuario) return redirect()->back()->with('errorName', 'Usuario no encontrado')->withInput();
        //if ($usuario->usua_vigente == 'N') return redirect()->back()->with('errorRut', 'El usuario no se encuentra habilitado para ingresar al sistema. Por favor verifique si su rol es el correcto, de lo contrario, notifique al administrador.')->withInput();

        $validarClave = Hash::check($request->clave, $usuario->contrasenia);
        if (!$validarClave) return redirect()->back()->with('errorClave', 'La contraseña es incorrecta.')->withInput();
        $request->session()->put('admin', $usuario);

        return redirect()->route('home.index');
    }

    // TODO: Cerrar Sesion
    public function cerrarSesion() {
        if (Session::has('admin')) {
            Session::forget('admin');
            return redirect()->route('ingresar.formulario')->with('sessionFinalizada', 'Sesión finalizada.');
        }
        return redirect()->back();
    }

    // TODO: Guardar Registro
    public function guardarRegistro(Request $request)
    {
        $request->validate(
            [
                'nombre_usuario' => 'required|max:100',
                'nombre' => 'required|max:100',
                'apellido' => 'required|max:100',
                'email' => 'max:100',
                'telefono' => 'max:100',
                'clave' => 'required|min:8|max:25',
                // 'unidad' => 'required'
            ],
            [
                //Nombre de Usuario
                'nombre_usuario.required' => 'Es necesario ingresar un nombre de usuario.',
                'nombre_usuario.max' => 'El nombre ingresado excede el máximo de caracteres permitidos (100).',
                //Nombre
                'nombre.required' => 'El nombre del usuario es requerido.',
                'nombre.max' => 'El nombre ingresado excede el máximo de caracteres permitidos (100).',
                //Aperllido
                'apellido.required' => 'El apellido del usuario es requerido.',
                'apellido.max' => 'El apellido ingresado excede el máximo de caracteres permitidos (100).',
                //COrreo
                'email.max' => 'El email ingresado excede el máximo de caracteres permitidos (100).',
                //Clave
                'clave.required' => 'La contraseña es requerida.',
                'clave.min' => 'La contraseña debe tener 8 caracteres como mínimo.',
                'clave.max' => 'La contraseña debe tener 25 caracteres como máximo.',
            ]
        );

        $usuaVerificar = Usuarios::where(['usua_rut' => $request->run, 'rous_codigo' => $request->rol])->first();
        if ($usuaVerificar) return redirect()->back()->with('errorUsuario', 'El usuario ya se encuentra registrado en el sistema.')->withInput();
        $valueID = (Usuarios::count(['nombre_usuario'])) + 1;

        $usuario = Usuarios::create([
            'nombre_usuario' => $request->nombre_usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo_electronico' => $request->email,
            'telefono' => $request->telefono,
            'contrasenia' => Hash::make($request->clave),
            'estado' => 1,
            'visible' => 1,
            'id_perfil' => $valueID,
            'fecha_creacion' => Carbon::now()->toDateString(),
        ]);
        
        if (!$usuario) return view('auth.ingresar')->with('errorCreate', 'El usuario no se pudo crear, intente más tarde.');
        return view('auth.ingresar')->with('exitoCreacion', 'El usuario fue creado correctamente.');
    }
}
