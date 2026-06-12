<?php

namespace App\Http\Controllers\Api;

use App\Events\MatchResultRecorded;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MatchGameResource;
use App\Models\MatchGame;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;


class MatchGameController extends Controller
{

    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $matches = MatchGame::all();
        } else {
            $matches = MatchGame::whereBetween('match_date_time', [
                now()->startOfDay(),
                now()->addDay()->setTime(8, 0, 0),
            ])->get();
        }

        return MatchGameResource::collection($matches);
    }
    public function store(StoreMatchRequest $request)
    {
        $match = MatchGame::create($request->validated());
        return response()->json(new MatchGameResource($match), 201);
    }
    public function update(UpdateMatchRequest $request, MatchGame $matchGame)
    {
        $matchGame->update($request->validated());
        if ($matchGame->final_home_goals !== null && $matchGame->final_away_goals !== null) {
            MatchResultRecorded::dispatch($matchGame);
        }
        return response()->json(new MatchGameResource($matchGame));
    }
    public function destroy(MatchGame $matchGame)
    {
        $matchGame->delete();
        return response()->json(['message' => 'Partido eliminado'], 200);
    }
}
