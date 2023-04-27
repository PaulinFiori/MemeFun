<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostsServiceInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    private $postsService;

    public function __construct(PostsServiceInterface $postsService) 
    {
        $this->postsService = $postsService;
    }

    public function novoPost() {
        return view("novo-post");
    }

    public function salvarNovoPost(Request $request) {
        $this->postsService->salvarMeme($request);

        return redirect()->route("home");
    }

    public function memeEspecifico($id) {
        $meme = $this->postsService->buscarMeme(base64_decode($id));

        return view("meme-especifico", ["meme" => $meme]);
    }

    public function curtiMeme(Request $request) {
        $this->postsService->curtiMeme(base64_decode($request->id));

        return response()->json(true);
    }

    public function baixarMeme($id) {
        $meme = $this->postsService->buscarMeme(base64_decode($id));

        $urlDissecada = explode('/', $meme->anexo);
        $path = explode('storage/', $meme->anexo);
            
        $headers = [
            'Content-Type'        => 'Content-Type: application/zip',
            'Content-Disposition' => 'attachment; filename="'. $urlDissecada[2] .'"',
        ];

        return Response::make(Storage::disk('public')->get($path[1]), 200, $headers);
    }

    public function comentarMeme(Request $request) {
        $meme = $this->postsService->comentarMeme($request);

        return response()->json(true);
    }

    public function excluirMeme(Request $request) {
        $this->postsService->excluirMeme($request);

        return response()->json(true);
    }

    public function reportarMeme(Request $request) {
        $this->postsService->reportarMeme($request);

        return response()->json(true);
    }

    public function excluirComentario(Request $request) {
        $this->postsService->excluirComentario($request);

        return response()->json(true);
    }

    public function reportarComentario(Request $request) {
        $this->postsService->reportarComentario($request);

        return response()->json(true);

    }
}
