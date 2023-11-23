<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class RankingService implements RankingServiceInterface
{
    public function montarRanking(Request $request) {
        //Memes +10
        //Curtidas no meme + 10
        //Comentarios no meme + 10

        //post comunidade +10
        //Curtidas no post comunidade+ 10
        //Comentarios no post comunidade + 10

        $ranking = DB::select('SELECT
            user_points.name,
            user_points.foto,
            pontos,
            DENSE_RANK() OVER (ORDER BY pontos DESC) AS posicao
            FROM (
                SELECT
                    u.id,
                    u.name,
                    u.foto,
                    (SELECT COUNT(*) * 10
                    FROM meme me
                    WHERE me.user_id = u.id AND me.deleted_at IS NULL) +
                    (SELECT COUNT(*) * 10
                    FROM curtida_meme cm
                    INNER JOIN meme me ON cm.meme_id = me.id
                    WHERE me.user_id = u.id AND me.deleted_at IS NULL AND cm.deleted_at IS NULL) +
                    (SELECT COUNT(*) * 10
                    FROM comentario_meme cm
                    INNER JOIN meme me ON cm.meme_id = me.id
                    WHERE me.user_id = u.id AND me.deleted_at IS NULL AND cm.deleted_at IS NULL) +
                    (SELECT COUNT(*) * 10
                    FROM post po
                    WHERE po.user_id = u.id AND po.deleted_at IS NULL) +
                    (SELECT COUNT(*) * 10
                    FROM curtida_post cp
                    INNER JOIN post po ON cp.post_id = po.id
                    WHERE po.user_id = u.id AND po.deleted_at IS NULL AND cp.deleted_at IS NULL) +
                    (SELECT COUNT(*) * 10
                    FROM comentario_post cp
                    INNER JOIN post po ON cp.post_id = po.id
                    WHERE po.user_id = u.id AND po.deleted_at IS NULL AND cp.deleted_at IS NULL) AS pontos
                FROM users u
            ) AS user_points
            ORDER BY pontos DESC');
        
        $ranking = $this->arrayPaginator($ranking, $request);

        return $ranking;
    }

    public function arrayPaginator($array, $request) {
        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
}