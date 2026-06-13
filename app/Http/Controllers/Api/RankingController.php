<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRankingResource;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;



class RankingController extends Controller
{
    #[OA\Get(
    path: '/api/ranking',
    summary: 'Ranking general de usuarios ordenado por puntos totales',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Ranking de usuarios con puntos'),
        new OA\Response(response: 401, description: 'No autenticado'),
    ]
)]
public function index()
{
    $users = User::with(['matchPredictions', 'championPrediction'])->get();

    $users = $users->map(function ($user) {
        $user->match_points = $user->matchPredictions->sum(function ($p) {
            return ($p->points_sign ?? 0) 
                + ($p->points_home_goals ?? 0) 
                + ($p->points_away_goals ?? 0) 
                + ($p->points_bonus ?? 0);
        });
        $user->champion_points = $user->championPrediction?->points_champion ?? 0;
        return $user;
    })->sortByDesc(function ($user) {
        return $user->match_points + $user->champion_points;
    })->values();

    return UserRankingResource::collection($users);
}
}
