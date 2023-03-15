<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface PerfilServiceInterface
{
    function editar(Request $request);

    function buscarMemes();
}