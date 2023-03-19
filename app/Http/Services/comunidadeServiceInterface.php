<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface ComunidadeServiceInterface
{
    function buscarPostComunidade();
    
    function salvarPostComunidade($request);
}