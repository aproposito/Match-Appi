<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchGameResource extends JsonResource
{
public function toArray(Request $request): array
{
   return [
    'id' => $this->id,
    'home_team' => new TeamResource($this->whenLoaded('homeTeam')),
    'away_team' => new TeamResource($this->whenLoaded('awayTeam')),
    'phase' => $this->phase,
    'match_date_time' => $this->match_date_time,
    'final_home_goals' => $this->final_home_goals,
    'final_away_goals' => $this->final_away_goals,
];
}
}
