<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Services\RankingServiceInterface;

class RankingController extends Controller
{
    private $rankingService;

    public function __construct(RankingServiceInterface $rankingService) 
    {
        $this->rankingService = $rankingService;
    }

    public function ranking(Request $request) {
        $ranking = $this->rankingService->montarRanking($request);

        if($request->ajax()) {
            $view = view('layouts._components.ranking', compact('ranking'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $ranking->nextPageUrl()]);
        }

        return view("ranking", ["ranking" => $ranking]);
    }
}
