<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface ComunidadeServiceInterface
{
    function buscarPost($id);
    
    function buscarPostComunidade();

    function buscarComentario($id);

    function buscarComentarioByPost($id);

    function buscarComentariosRespostas($id);
    
    function salvarPostComunidade($request);

    function curtiPostComunidade($request);

    function comentarPostComunidade($request);

    function reportarPostComunidade($request);

    function excluirPostComunidade($request);

    function reportarComentarioComunidade($request);

    function excluirComentarioComunidade($request);
}