<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
