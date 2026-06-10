<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatchPredictionRequest;
use Illuminate\Http\Request;
use App\Http\Resources\MatchPredictionResource;
use App\Models\MatchPrediction;


class MatchPredictionController extends Controller
{

public function index(Request $request)
{
    if ($request->user()->role === 'admin') {
        $predictions = MatchPrediction::all();
    } else {
        $predictions = MatchPrediction::where('user_id', $request->user()->id)->get();
    }
    return MatchPredictionResource::collection($predictions);
}
public function store(StoreMatchPredictionRequest $request)
{
    $prediction = MatchPrediction::create([
        'match_id' => $request->match_id,
        'user_id' => $request->user()->id,
        'predicted_home_goals' => $request->predicted_home_goals,
        'predicted_away_goals' => $request->predicted_away_goals,
    ]);

    return response()->json(new MatchPredictionResource($prediction), 201);
}
}
