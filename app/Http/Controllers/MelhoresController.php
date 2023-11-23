<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Services\MelhoresServiceInterface;

class MelhoresController extends Controller
{
    private $melhoresService;

    public function __construct(MelhoresServiceInterface $melhoresService) 
    {
        $this->melhoresService = $melhoresService;
    }

    public function melhores(Request $request) {
        $memes = $this->melhoresService->buscarMelhoresMemesSemana();

        if($request->ajax()) {
            $view = view('layouts._components.memes', compact('memes'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $memes->nextPageUrl()]);
        }
        
        return view("melhores", ['memes' => $memes]);
    }
}
