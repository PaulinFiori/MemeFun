<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\UserConfiguracoes;

class ConfiguracoesService implements ConfiguracoesServiceInterface
{
    public function buscarConfiguracoes($id) {
        return UserConfiguracoes::find($id);
    }

    public function salvarConfiguracoes(Request $request) {
        $userConfiguracoes = auth()->user()->configuracao;
        
        if($request->_token != '') {
            if($userConfiguracoes == null) {
                $userConfiguracoes = new UserConfiguracoes();
                $userConfiguracoes->user_id = auth()->user()->id; 
            }

            if($request->dark_mode == "off") {
                $userConfiguracoes->modo_escuro = 0;
            } else {
                $userConfiguracoes->modo_escuro = 1;
            }

            if($request->corTexto != null) {
                $userConfiguracoes->texto_cor = $request->corTexto;
            }

            if($request->bordaTexto != null) {
                $userConfiguracoes->borda_texto_cor = $request->bordaTexto;
            }

            $userConfiguracoes->save();
        } else {
            return "Ocorreu um erro no servidor.";
        }
    }
}