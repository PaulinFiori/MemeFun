<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface CadastrarServiceInterface
{
    function salvar(Request $request);
}