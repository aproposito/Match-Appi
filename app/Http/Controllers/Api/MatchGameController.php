<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MatchGameResource;
use App\Models\MatchGame;
use App\Http\Requests\StoreMatchRequest;


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
public function store(StoreMatchRequest $request)
{
    $match = MatchGame::create($request->validated());
    return response()->json(new MatchGameResource($match), 201);
}

}


