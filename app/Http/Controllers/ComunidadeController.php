<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ComunidadeServiceInterface;

class ComunidadeController extends Controller
{
    private $comunidadeService;

    public function __construct(ComunidadeServiceInterface $comunidadeService) 
    {
        $this->comunidadeService = $comunidadeService;
    }

    public function comunidades() {
        $posts = $this->comunidadeService->buscarPostComunidade();

        return view("comunidade", ["posts" => $posts]);
    }

    public function novoPostComunidade() {
        return view("novo-post-comunidade");
    }

    public function postEspecifico($id) {
        $post = $this->comunidadeService->buscarPost(base64_decode($id));

        return view("post-especifico", ["post" => $post]);
    }


    public function salvarNovoPostComunidade(Request $request) {
        $this->comunidadeService->salvarPostComunidade($request);

        return redirect()->route("comunidades");
    }

    public function curtiPostComunidade(Request $request) {
        $this->comunidadeService->curtiPostComunidade($request);

        return response()->json(true);
    }

    public function comentarPostComunidade(Request $request) {
        $this->comunidadeService->comentarPostComunidade($request);

        return response()->json(true);
    }

    public function reportarPostComunidade(Request $request) {
        $this->comunidadeService->reportarPostComunidade($request);

        return response()->json(true);
    }

    public function excluirPostComunidade(Request $request) {
        $this->comunidadeService->excluirPostComunidade($request);

        return response()->json(true);
    }

    public function reportarComentarioComunidade(Request $request) {
        $this->comunidadeService->reportarComentarioComunidade($request);

        return response()->json(true);
    }

    public function excluirComentarioComunidade(Request $request) {
        $this->comunidadeService->excluirComentarioComunidade($request);

        return response()->json(true);
    }
}
