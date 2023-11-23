<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
    public function index(Request $request)
    {
        $memes = $this->homeService->buscarMemes();

        if($request->ajax()) {
            $view = view('layouts._components.memes', compact('memes'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $memes->nextPageUrl()]);
        }

        return view('home-feed', [
            'memes' => $memes
        ]);
    }
}
