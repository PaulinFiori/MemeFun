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
            ->where('seguidores.user_seguidor_id', 0)
            ->orderBy("meme.created_at", "desc")
            ->get();
        }

        return Meme::select('meme.*')
            ->join('users', 'meme.user_id', '=', 'users.id')
            ->join('seguidores', 'users.id', '=', 'seguidores.user_id')
            ->where('seguidores.user_seguidor_id', auth()->user()->id)
            ->orderBy("meme.created_at", "desc")
            ->get();
    }
}