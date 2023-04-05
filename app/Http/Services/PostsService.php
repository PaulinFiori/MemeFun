<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Meme;

class PostsService implements PostsServiceInterface
{
    public function buscarMeme($id) {
        return Meme::find($id);
    }

    public function salvarMeme($request) {
        if($request->_token) {
            $meme = new Meme();

            $meme->titulo = $request->titulo;

            if($request->descricao) $meme->descricao = $request->descricao;

            $file = $request->file('arquivo');

            //todo: salvar no s3
            /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Fotos/", $file);*/

            $imagemUrn = $file->store('imagens', 'public');

            $linkDaFoto = 'storage/' . $imagemUrn;

            $meme->anexo = $linkDaFoto;
            $meme->extensao = $request->file('arquivo')->getClientOriginalExtension();

            $meme->user_id = auth()->user()->id;

            $meme->save();
        }
    }
}