<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\Meme;

class HomeService implements HomeServiceInterface
{
    public function buscarMemes() {
        return Meme::orderBy("created_at", "desc")->get();
    }
}