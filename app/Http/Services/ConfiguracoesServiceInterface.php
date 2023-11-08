<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface ConfiguracoesServiceInterface
{
    public function buscarConfiguracoes($id);

    public function salvarConfiguracoes(Request $request);
}