<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Meme;
use App\Models\CurtidaMeme;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MelhoresService implements MelhoresServiceInterface
{
    public function buscarMelhoresMemesSemana() {
        $periodo = 7; // número de dias
        $hoje = date('Y-m-d'); // data atual
        $limite = date('Y-m-d', strtotime("-$periodo days")); // data limite

        $memes_populares = Meme::join('curtida_meme', 'meme.id', '=', 'curtida_meme.meme_id')
            ->select('meme.*')
            ->whereBetween('meme.created_at', [$limite, $hoje])
            ->groupBy('meme.id')
            ->orderBy(DB::raw('COUNT(curtida_meme.meme_id)'), 'desc')
            ->paginate(10);

        return $memes_populares;
    }
}