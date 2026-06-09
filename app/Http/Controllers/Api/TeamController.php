<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamResource;
use App\Http\Requests\StoreTeamRequest;

class TeamController extends Controller
{
    public function index()
    {
        return TeamResource::collection(Team::all());
    }

    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->validated());
        return response()->json(new TeamResource($team), 201);
    }
}
