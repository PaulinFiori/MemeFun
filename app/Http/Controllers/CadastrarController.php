<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CadastrarServiceInterface;
use RealRashid\SweetAlert\Facades\Alert;

class CadastrarController extends Controller
{
    private $cadastrarService;

    public function __construct(CadastrarServiceInterface $cadastrarService) 
    {
        $this->cadastrarService = $cadastrarService;
    }

    public function index() {
        return view('auth.register');
    }

    public function salvarCadastro(Request $request) {
        $msg = $this->cadastrarService->salvar($request);

        if($msg == "Imagem enviada é maior do que 5mb.") {
            return redirect()->route("cadastro", ["erro" => Alert::error($msg)]);
        }

        return redirect('/login')->with(['msg' => $msg]);
    }
}