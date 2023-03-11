<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperarSenhaController extends Controller
{
    public function index() {
        return view('recuperar-senha');
    }

    public function novaSenha() {
        return view('nova-senha');
    }

    public function enviarSenha() {
        return view('nova-senha');
    }

    public function salvarSenha() {
        return view('nova-senha');
    }
}
