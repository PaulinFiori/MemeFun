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

        return view("seguidores", ['memes' => $memes]);
    }
}
