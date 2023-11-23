<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PesquisaServiceInterface;

class PesquisaController extends Controller
{
    private $pesquisaService;

    public function __construct(PesquisaServiceInterface $pesquisaService) 
    {
        $this->pesquisaService = $pesquisaService;
    }

    public function pesquisa(Request $request) {
        $memes = $this->pesquisaService->pesquisarMemes($request);
        $posts = $this->pesquisaService->pesquisarPosts($request);
        $contas = $this->pesquisaService->pesquisarContas($request);

        return view("pesquisa", [
            "memes" => $memes,
            "posts" => $posts,
            "contas" => $contas
        ]);
    }
}
