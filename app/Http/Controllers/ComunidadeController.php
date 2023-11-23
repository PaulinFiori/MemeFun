<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Services\ComunidadeServiceInterface;
use RealRashid\SweetAlert\Facades\Alert;

class ComunidadeController extends Controller
{
    private $comunidadeService;

    public function __construct(ComunidadeServiceInterface $comunidadeService) 
    {
        $this->comunidadeService = $comunidadeService;
    }

    public function comunidades(Request $request) {
        $posts = $this->comunidadeService->buscarPostComunidade();

        if($request->ajax()) {
            $view = view('layouts._components.posts', compact('posts'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $posts->nextPageUrl()]);
        }

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
        $resposta = $this->comunidadeService->salvarPostComunidade($request);

        if($resposta != null) {
            return redirect()->route("novo-post-comunidade", ["erro" => Alert::error($resposta)]);
        } else {
            return redirect()->route("comunidades");
        }
    }

    public function curtiPostComunidade(Request $request) {
        if($request->_token) {
            $this->comunidadeService->curtiPostComunidade($request);
        }

        return response()->json(true);
    }

    public function comentarPostComunidade(Request $request) {
        if($request->_token) {
            $this->comunidadeService->comentarPostComunidade($request);
        }

        return response()->json(true);
    }

    public function reportarPostComunidade(Request $request) {
        if($request->_token) {
            $this->comunidadeService->reportarPostComunidade($request);
        }

        return response()->json(true);
    }

    public function excluirPostComunidade(Request $request) {
        if($request->_token) {
            $this->comunidadeService->excluirPostComunidade($request);
        }

        return response()->json(true);
    }

    public function reportarComentarioComunidade(Request $request) {
        if($request->_token) {
            $this->comunidadeService->reportarComentarioComunidade($request);
        }

        return response()->json(true);
    }

    public function excluirComentarioComunidade(Request $request) {
        if($request->_token) {
            $this->comunidadeService->excluirComentarioComunidade($request);
        }

        return response()->json(true);
    }
}
