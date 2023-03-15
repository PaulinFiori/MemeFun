<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostsServiceInterface;

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

    public function novoPostComunidade() {
        return view("novo-post-comunidade");
    }

    public function memeEspecifico($id) {
        return view("meme-especifico");
    }
}
