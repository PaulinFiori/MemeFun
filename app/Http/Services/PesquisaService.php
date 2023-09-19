<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Meme;
use App\Models\Post;
use App\Models\Seguindo;
use App\Models\Seguidores;
use Illuminate\Support\Facades\DB;

class PesquisaService implements PesquisaServiceInterface
{
    public function pesquisarMemes(Request $request) {
        $memes = Meme::where("titulo", "like", "%" . $request->busca . "%")
            ->orWhere("descricao", "like", "%" . $request->busca . "%")
            ->paginate(4);

        return $memes;
    }

    public function pesquisarPosts(Request $request) {
        $posts = Post::where("titulo", "like", "%" . $request->busca . "%")
            ->orWhere("descricao", "like", "%" . $request->busca . "%")
            ->paginate(4);

        return $posts;
    }

    public function pesquisarContas(Request $request) {
        $contas = User::where("name", "like", "%" . $request->busca . "%")->paginate(4);

        return $contas;
    }
}