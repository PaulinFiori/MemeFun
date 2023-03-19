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

    public function salvarNovoPostComunidade(Request $request) {
        $this->comunidadeService->salvarPostComunidade($request);

        return redirect()->route("comunidades");
    }
}
