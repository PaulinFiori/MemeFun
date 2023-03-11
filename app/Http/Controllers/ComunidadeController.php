<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComunidadeController extends Controller
{
    public function comunidades() {
        return view("comunidade");
    }
}
