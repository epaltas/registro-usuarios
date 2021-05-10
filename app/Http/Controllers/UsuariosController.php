<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Lista de usuarios, se mostrarán solamente 5 de la base de datos
        $datos['usuarios']=Usuarios::paginate(5);
        return view('usuario.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Vista de crear usuarios
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        //validaciones
        
        $validated = $request-> validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'cedula' => 'required|numeric',
            'email'  => 'required|email|unique:usuarios',
            'password' =>['required', 'confirmed', Password::min(8)->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()],
            'date_of_birth' => 'required|date',
        ]);

        $passwordEncryp = Hash::make($request->password);

        //recolectar información a excepción del token y confirmación de contrasseña
        $datosUsuario = request()->except('_token','password_confirmation');
        Usuarios::insert($datosUsuario);
        //return response()->json($datosUsuario);
        return redirect('usuario')->with('mensaje','Usuario agregado correctamente');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Vista para editar usuario
        $usuario=Usuarios::findOrFail($id);
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedEdit = $request-> validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'cedula' => 'required|numeric',
            'email'  => 'required|email',
            'password' =>['required', 'confirmed', Password::min(8)->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()],
        ]);

        //Actualización de datos 
        $datosUsuario = request()->except('_token','_method','password_confirmation');
        Usuarios::where('id','=',$id)->update($datosUsuario);

        $usuario=Usuarios::findOrFail($id);
        //return view('usuario.edit', compact('usuario'));
        return redirect('usuario')->with('mensaje','Usuario modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar registros de usuario en base el parámetro id
        Usuarios::destroy($id);
        return redirect('usuario')->with('mensaje','Usuario eliminado');
    }
}