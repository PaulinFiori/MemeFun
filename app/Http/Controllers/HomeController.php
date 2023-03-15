<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HomeServiceInterface;

class HomeController extends Controller
{
    private $homeService;

    public function __construct(HomeServiceInterface $homeService) 
    {
        $this->homeService = $homeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $memes = $this->homeService->buscarMemes();

        return view('home-feed', [
            'memes' => $memes
        ]);
    }
}
