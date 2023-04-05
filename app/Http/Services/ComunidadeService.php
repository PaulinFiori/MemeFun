<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Post;

class ComunidadeService implements ComunidadeServiceInterface
{
    public function buscarPostComunidade() {
        return Post::orderBy("id", "desc")->get();
    }

    public function salvarPostComunidade($request) {
        if($request->_token != null) {
            $post = new Post();

            $post->titulo = $request->titulo;

            if($request->titulo) $post->descricao = $request->descricao;

            if($request->arquivo != null) {
                $file = $request->file('arquivo');

                //todo: salvar no s3
                /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Fotos/", $file);*/

                $imagemUrn = $file->store('imagens', 'public');

                $linkDaFoto = 'storage/' . $imagemUrn;
                $post->extensao = $request->file('arquivo')->getClientOriginalExtension();

                $post->anexo = $linkDaFoto;
            }

            $post->user_id = auth()->user()->id; 

            $post->save();
        }
    }
}