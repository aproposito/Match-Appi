<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
