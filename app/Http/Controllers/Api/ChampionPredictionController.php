<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChampionPredictionRequest;
use App\Http\Resources\ChampionPredictionResource;
use App\Models\ChampionPrediction;
use Illuminate\Http\Request;


class ChampionPredictionController extends Controller
{


public function index(Request $request)
{
    if ($request->user()->role === 'admin') {
        $predictions = ChampionPrediction::all();
    } else {
        $predictions = ChampionPrediction::where('user_id', $request->user()->id)->get();
    }

    return ChampionPredictionResource::collection($predictions);
}
public function store(StoreChampionPredictionRequest $request)
{
    $prediction = ChampionPrediction::create([
        'user_id' => $request->user()->id,
        'team_id' => $request->team_id,
    ]);

    return response()->json(new ChampionPredictionResource($prediction), 201);
}
}
