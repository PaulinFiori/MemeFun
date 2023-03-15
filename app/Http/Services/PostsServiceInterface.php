<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface PostsServiceInterface
{
    function salvarMeme($request);
}