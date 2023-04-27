<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface PostsServiceInterface
{
    function buscarMeme($id);

    function buscarComentario($id);

    function buscarComentariosRespostas($id);
    
    function salvarMeme($request);

    function curtiMeme($id);

    function comentarMeme($request);

    function excluirMeme($request);

    function reportarMeme($request);

    function excluirComentario($meme);

    function reportarComentario($request);
}