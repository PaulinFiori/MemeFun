<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface PerfilServiceInterface
{
    function editar(Request $request);

    function buscarMemes($id);

    function buscarUsuario($id);

    function seguir($id);

    function deseguir($id);
}