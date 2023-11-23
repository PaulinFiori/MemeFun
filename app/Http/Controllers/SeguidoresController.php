<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Services\SeguidoresServiceInterface;

class SeguidoresController extends Controller
{
    private $seguidoresService;

    public function __construct(SeguidoresServiceInterface $seguidoresService) 
    {
        $this->seguidoresService = $seguidoresService;
    }

    public function seguidores(Request $request) {
        $memes = $this->seguidoresService->memesSeguidores();

        if($request->ajax()) {
            if(auth()->user() == null) {
                return view("seguidores", [
                    'error' => true,
                    'mensagem' => "Faça login para ver os memes!",
                    'memes' => $memes
                ]);
            } else {
                $view = view('layouts._components.memes', compact('memes'))->render();
                return Response::json(['view' => $view, 'nextPageUrl' => $memes->nextPageUrl()]);
            }
        }

        return view("seguidores", ['memes' => $memes]);
    }
}
