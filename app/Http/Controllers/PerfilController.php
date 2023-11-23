<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Services\PerfilServiceInterface;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    private $perfilService;

    public function __construct(PerfilServiceInterface $perfilService) 
    {
        $this->perfilService = $perfilService;
    }


    public function perfil(Request $request) {
        $id = explode('perfil/', url()->current())[1];
        $memes = $this->perfilService->buscarMemes(base64_decode($id));
        $usuario = $this->perfilService->buscarUsuario(base64_decode($id));
        $seguindos = $usuario->seguindo()->paginate(10);
        $seguidores = $usuario->seguidores()->paginate(10);

        if($request->ajax()) {
            if($_GET['tab'] == "seguidores") {
                $view = view('layouts._components.seguidores', compact('seguidores'))->render();
                return Response::json(['view' => $view, 'nextPageUrl' => $seguidores->nextPageUrl()]);
            } else if($_GET['tab'] == "seguindo") {
                $view = view('layouts._components.seguindo', compact('memes'))->render();
                return Response::json(['view' => $view, 'nextPageUrl' => $seguindos->nextPageUrl()]);
            } else {
                $view = view('layouts._components.memes', compact('memes'))->render();
                return Response::json(['view' => $view, 'nextPageUrl' => $memes->nextPageUrl()]);
            }
        }

        return view("perfil", [
            "memes" => $memes,
            "usuario" => $usuario,
            "seguindos" => $seguindos,
            "seguidores" => $seguidores
        ]);
    }

    public function seguidores(Request $request) {
        $id = explode('perfil/', url()->current())[1];
        $seguidores = $this->perfilService->seguidores(base64_decode($id));

        if($request->ajax()) {
            $view = view('layouts._components.seguidores', compact('seguidores'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $seguidores->nextPageUrl()]);
        }
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
