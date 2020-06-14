<?php

namespace App\Http\Controllers;

use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $usuarios = Usuario::get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        return view('usuarios.show', compact('usuario'));
    }
}
