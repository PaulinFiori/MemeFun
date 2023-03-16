<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MelhoresServiceInterface;

class MelhoresController extends Controller
{
    private $melhoresService;

    public function __construct(MelhoresServiceInterface $melhoresService) 
    {
        $this->melhoresService = $melhoresService;
    }

    public function melhores() {
        $memes = $this->melhoresService->buscarMelhoresMemesSemana();
        
        return view("melhores", ['memes' => $memes]);
    }
}
