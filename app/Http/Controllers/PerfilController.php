<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PerfilServiceInterface;

class PerfilController extends Controller
{
    private $perfilService;

    public function __construct(PerfilServiceInterface $perfilService) 
    {
        $this->perfilService = $perfilService;
    }


    public function perfil() {
        $id = explode('perfil/', url()->current())[1];
        $memes = $this->perfilService->buscarMemes($id);
        $usuario = $this->perfilService->buscarUsuario($id);

        return view("perfil", [
            "memes" => $memes,
            "usuario" => $usuario
        ]);
    }

    public function editarPerfil() {
        return view("editar-perfil");
    }

    public function salvarEditarPerfil(Request $request) {
        $this->perfilService->editar($request);

        return redirect()->route("editar-perfil");
    }

    public function configuracoes() {
        return view("configuracoes");
    }

    public function sair() {
        
    }
}
