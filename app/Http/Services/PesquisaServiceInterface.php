<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface PesquisaServiceInterface
{
    function pesquisarMemes(Request $request);

    function pesquisarPosts(Request $request);

    function pesquisarContas(Request $request);
}