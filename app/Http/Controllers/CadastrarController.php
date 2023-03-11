<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\CadastrarServiceInterface;

class CadastrarController extends Controller
{
    private $cadastrarService;

    public function __construct(CadastrarServiceInterface $cadastrarService) 
    {
        $this->cadastrarService = $cadastrarService;
    }

    public function index() {
        return view('cadastrar');
    }

    public function salvarCadastro(Request $request) {
        $msg = $this->cadastrarService->salvar($request);

        return redirect('/login')->with(['msg' => $msg]);
    }
}