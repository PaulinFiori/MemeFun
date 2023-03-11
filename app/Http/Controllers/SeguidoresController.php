<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguidoresController extends Controller
{
    public function seguidores() {
        return view("seguidores");
    }
}
