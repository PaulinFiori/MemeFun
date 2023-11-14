<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Meme;
use App\Models\CurtidaMeme;
use App\Models\ComentarioMeme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportarComentarioMeme;
use App\Mail\ReportarMeme;

class PostsService implements PostsServiceInterface
{
    public function buscarMeme($id) {
        return Meme::find($id);
    }

    public function buscarComentario($id) {
        return ComentarioMeme::find($id);
    }

    public function buscarComentariosRespostas($id) {
        return ComentarioMeme::where('id_comentario_meme', $id)->get();
    }

    public function buscarComentarioByMeme($id) {
        return ComentarioMeme::where('meme_id', $id)->get();
    }

    public function salvarMeme($request) {
        if($request->_token) {
            $tamanhoArquivo = (filesize($request->file('arquivo')) / 1024) / 1024;

            if($tamanhoArquivo < 5.0) {
            $meme = new Meme();

            $meme->titulo = $request->titulo;

            if($request->descricao) $meme->descricao = $request->descricao;

            $file = $request->file('arquivo');

            if($file == null) return "Imagem ou vídeo não adicionado.";

            //todo: salvar no s3
            /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Fotos/", $file);*/

            $imagemUrn = $file->store('imagens', 'public');

            $linkDaFoto = 'storage/' . $imagemUrn;

            $meme->anexo = $linkDaFoto;
            $meme->extensao = $request->file('arquivo')->getClientOriginalExtension();

            $meme->user_id = auth()->user()->id;

            $meme->save();
            } else {
                return "Imagem ou vídeo enviado é maior do que 5mb.";
            }
        } else {
            return "Ocorreu um erro no servidor.";
        }
    }

    public function curtiMeme($id) {
        $meme = $this->buscarMeme($id);
        $jaCurtiuMeme = CurtidaMeme::where('meme_id', $meme->id)->where('user_id', auth()->user()->id)->first();

        if($jaCurtiuMeme == null) {
            CurtidaMeme::create([
                'user_id' => auth()->user()->id,
                'meme_id' => $meme->id
            ]);
        } else {
            $jaCurtiuMeme->delete();
        }
    }

    public function comentarMeme($request) {
        if($request->id_comentario_meme == null) {
            ComentarioMeme::create([
                'user_id' => auth()->user()->id,
                'meme_id' => $request->id,
                'descricao' => $request->comentario
            ]);
        } else {
            ComentarioMeme::create([
                'user_id' => auth()->user()->id,
                'meme_id' => $request->id,
                'descricao' => $request->comentario,
                'id_comentario_meme' => $request->id_comentario_meme
            ]);
        }
    }

    public function excluirMeme($request) {
        $meme = $this->buscarMeme($request->id);

        foreach($meme->comentarios as $comentario) {
            $comentario->delete();
        }

        foreach($meme->curtidas as $curtida) {
            $curtida->delete();
        }

        $meme->delete();
    }

    public function reportarMeme($request) {
        $meme = $this->buscarMeme($request->id);
        $url = route('meme-especifico', ['id' => $request->meme_id]);

        Mail::to("paulofiori34@gmail.com")->send(new ReportarMeme($meme->titulo, $url));
    }

    public function excluirComentario($request) {
        $comentario = $this->buscarComentario($request->id);
        $subComentarios = $this->buscarComentariosRespostas($request->id);

        if($subComentarios != null) {
            foreach($subComentarios as $subComentario) {
                $subComentario->delete();
            }
        }

        if($comentario != null) $comentario->delete();
    }

    public function reportarComentario($request) {
        $comentario = $this->buscarComentario($request->id);
        $url = route('meme-especifico', ['id' => $request->meme_id]);

        Mail::to("paulofiori34@gmail.com")->send(new ReportarComentarioMeme($comentario->descricao, $comentario->meme->titulo, $comentario->meme->id, $url));
    }
}