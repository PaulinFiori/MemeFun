<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function perfil() {
        return view("perfil");
    }

    public function editarPerfil() {
        return view("editar-perfil");
    }

    public function configuracoes() {
        return view("configuracoes");
    }

    public function sair() {
        
    }
}
