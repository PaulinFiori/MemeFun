<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SeguidoresServiceInterface;

class SeguidoresController extends Controller
{
    private $seguidoresService;

    public function __construct(SeguidoresServiceInterface $seguidoresService) 
    {
        $this->seguidoresService = $seguidoresService;
    }

    public function seguidores() {
        $memes = $this->seguidoresService->memesSeguidores();

        if(auth()->user() == null) {
            return view("seguidores", [
                'error' => true,
                'mensagem' => "Faça login para ver os memes!",
                'memes' => $memes
            ]);
        }

        return view("seguidores", ['memes' => $memes]);
    }
}
