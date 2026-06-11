<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRankingResource;
use App\Models\User;
use Illuminate\Http\Request;



class RankingController extends Controller
{
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
