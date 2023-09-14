<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RankingServiceInterface;

class RankingController extends Controller
{
    private $rankingService;

    public function __construct(RankingServiceInterface $rankingService) 
    {
        $this->rankingService = $rankingService;
    }

    public function ranking() {
        $ranking = $this->rankingService->montarRanking();;

        return view("ranking", ["ranking" => $ranking]);
    }
}
