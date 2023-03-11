<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MelhoresController extends Controller
{
    public function melhores() {
        return view("melhores");
    }
}
