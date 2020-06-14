<?php

namespace App\Http\Controllers;

use App\Usuario;

class HomeController extends Controller
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

        return view('home', compact('usuarios'));
    }
}
