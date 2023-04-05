<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface PostsServiceInterface
{
    function buscarMeme($id);
    
    function salvarMeme($request);
}