<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MatchGameResource;
use App\Models\MatchGame;


class MatchGameController extends Controller
{

public function index(Request $request)
{
    if ($request->user()->role === 'admin') {
        $matches = MatchGame::all();
    } else {
        $matches = MatchGame::whereDate('match_date_time', today())->get();
    }

    return MatchGameResource::collection($matches);
}
}
