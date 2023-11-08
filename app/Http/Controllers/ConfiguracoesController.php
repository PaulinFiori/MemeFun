<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ConfiguracoesServiceInterface;

class ConfiguracoesController extends Controller
{
    private $configuracoesService;

    public function __construct(ConfiguracoesServiceInterface $configuracoesService) 
    {
        $this->configuracoesService = $configuracoesService;
    }

    public function configuracoes() {
        return view("configuracoes");
    }

    public function salvarConfiguracoes(Request $request) {
        $this->configuracoesService->salvarConfiguracoes($request);

        return response()->json(true);
    }
}