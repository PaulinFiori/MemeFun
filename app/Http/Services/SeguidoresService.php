<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Meme;

class SeguidoresService implements SeguidoresServiceInterface
{
    public function memesSeguidores() {
        if(auth()->user() == null) {
            return Meme::select('meme.*')
            ->join('users', 'meme.user_id', '=', 'users.id')
            ->join('seguidores', 'users.id', '=', 'seguidores.user_id')
            ->where('seguidores.seguido_por', 0)
            ->orderBy("meme.created_at", "desc")
            ->paginate(10);
        }

        return Meme::select('meme.*')
            ->join('users', 'meme.user_id', '=', 'users.id')
            ->join('seguidores', 'users.id', '=', 'seguidores.user_id')
            ->where('seguidores.seguido_por', auth()->user()->id)
            ->orderBy("meme.created_at", "desc")
            ->paginate(10);
    }
}