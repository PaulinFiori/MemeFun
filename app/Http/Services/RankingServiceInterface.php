<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface RankingServiceInterface
{
    function montarRanking(Request $request);
}