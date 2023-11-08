<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CurtidaPost;
use App\Models\ComentarioPost;
use App\Mail\RepotarComentarioPost;
use App\Mail\RepotarPost;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ComunidadeService implements ComunidadeServiceInterface
{
    public function buscarPost($id) {
        return Post::find($id);
    }

    public function buscarPostComunidade() {
        $post;
        
        if(!isset($_GET['filtro']) || $_GET['filtro'] == "ultimas") {
            $post = Post::orderBy("id", "desc")->get();
        } else if(isset($_GET['filtro']) && $_GET['filtro'] == "top") {
            $periodo = 7; // número de dias
            $hoje = date('Y-m-d'); // data atual
            $limite = date('Y-m-d', strtotime("-$periodo days")); // data limite

            $post = Post::join('curtida_post', 'post.id', '=', 'curtida_post.post_id')
                ->select('post.*')
                ->whereBetween('post.created_at', [$limite, $hoje])
                ->groupBy('post.id')
                ->orderBy(DB::raw('COUNT(curtida_post.post_id)'), 'desc')
                ->get();
        } else if(isset($_GET['filtro']) && $_GET['filtro'] == "seguindo") {
            $post = Post::select("post.*")
                ->join('seguindo', 'post.user_id', '=', 'seguindo.user_seguindo')
                ->where('seguindo.user_id', auth()->user()->id)
                ->orderBy("id", "desc")
                ->get();
        }

        return $post;
    }

    public function buscarComentario($id) {
        return ComentarioPost::find($id);
    }

    public function buscarComentarioByPost($id) {
        return ComentarioPost::where('post_id', $id)->get();
    }

    public function buscarComentariosRespostas($id) {
        return ComentarioPost::where('id_comentario_post', $id)->get();
    }

    public function salvarPostComunidade($request) {
        if($request->_token != null) {
            $tamanhoArquivo = (filesize($request->file('arquivo')) / 1024) / 1024;

            if($tamanhoArquivo < 5.0) {
                $post = new Post();

                if($request->titulo) $post->titulo = $request->titulo;

                $post->descricao = $request->descricao;

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
            } else {
                return "Imagem ou vídeo enviado é maior do que 5mb.";
            }
        } else {
            return "Ocorreu um erro no servidor.";
        }
    }

    public function curtiPostComunidade($request) {
        $post = $this->buscarPost($request->id);
        $jaCurtiuPost = CurtidaPost::where('post_id', $post->id)->where('user_id', auth()->user()->id)->where('curtida', $request->curtida)->first();

        if($jaCurtiuPost == null) {
            CurtidaPost::create([
                "post_id" => $post->id,
                "user_id" => auth()->user()->id,
                "curtida" => $request->curtida
            ]);
        } else {
            $jaCurtiuPost->delete();
        }
    }

    public function comentarPostComunidade($request) {
        if($request->id_comentario_post == null) {
            ComentarioPost::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->id,
                'descricao' => $request->comentario
            ]);
        } else {
            ComentarioPost::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->id,
                'descricao' => $request->comentario,
                'id_comentario_post' => $request->id_comentario_post
            ]);
        }
    }

    public function reportarPostComunidade($request) {
        $post = $this->buscarPost($request->id);
        $url = route('post-comunidade-especifico', ['id' => $request->post_id]);

        Mail::to("paulofiori34@gmail.com")->send(new RepotarPost($post->descricao, $url));
    }

    public function excluirPostComunidade($request) {
        $post = $this->buscarPost($request->id);

        foreach($post->comentarios as $comentario) {
            $comentario->delete();
        }

        foreach($post->curtidas as $curtida) {
            $curtida->delete();
        }

        $post->delete();
    }

    public function reportarComentarioComunidade($request) {
        $comentario = $this->buscarComentario($request->id);
        $url = route('post-comunidade-especifico', ['id' => $request->post_id]);

        Mail::to("paulofiori34@gmail.com")->send(new RepotarComentarioPost($comentario->descricao, $comentario->post->descricao, $comentario->post->id, $url));
    }

    public function excluirComentarioComunidade($request) {
        $comentario = $this->buscarComentario($request->id);
        $subComentarios = $this->buscarComentariosRespostas($request->id);

        if($subComentarios != null) {
            foreach($subComentarios as $subComentario) {
                $subComentario->delete();
            }
        }

        if($comentario != null) $comentario->delete();
    }
}