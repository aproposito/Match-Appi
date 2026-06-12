<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatchPredictionRequest;
use Illuminate\Http\Request;
use App\Http\Resources\MatchPredictionResource;
use App\Models\MatchPrediction;
use App\Http\Requests\UpdateMatchPredictionRequest;


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
    public function update(UpdateMatchPredictionRequest $request, MatchPrediction $matchPrediction)
    {
        $matchPrediction->update($request->validated());
        return response()->json(new MatchPredictionResource($matchPrediction));
    }
    public function destroy(Request $request, MatchPrediction $matchPrediction)
    {
        if ($request->user()->role !== 'admin' && $request->user()->id !== $matchPrediction->user_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $matchPrediction->delete();
        return response()->json(['message' => 'Predicción eliminada']);
    }
}
