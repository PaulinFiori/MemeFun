<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PerfilServiceInterface;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    private $perfilService;

    public function __construct(PerfilServiceInterface $perfilService) 
    {
        $this->perfilService = $perfilService;
    }


    public function perfil() {
        $id = explode('perfil/', url()->current())[1];
        $memes = $this->perfilService->buscarMemes(base64_decode($id));
        $usuario = $this->perfilService->buscarUsuario(base64_decode($id));

        return view("perfil", [
            "memes" => $memes,
            "usuario" => $usuario
        ]);
    }

    public function editarPerfil() {
        return view("editar-perfil");
    }

    public function salvarEditarPerfil(Request $request) {
        $resposta = $this->perfilService->editar($request);

        if($resposta != null) {
            return redirect()->route("editar-perfil", ["erro" => Alert::error($resposta)]);
        } else {
            return redirect()->route("editar-perfil");
        }
    }

    public function seguir(Request $request) {
        $this->perfilService->seguir($request->usuario_id);

        return response()->json('true');
    }

    public function deseguir(Request $request) {
        $this->perfilService->deseguir($request->usuario_id);

        return response()->json('true');
    }
}
