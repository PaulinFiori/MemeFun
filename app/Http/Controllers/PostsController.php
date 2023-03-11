<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function novoPost() {
        return view("novo-post");
    }

    public function novoPostComunidade() {
        return view("novo-post-comunidade");
    }

    public function memeEspecifico($id) {
        return view("meme-especifico");
    }
}
