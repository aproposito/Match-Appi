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
        'home_team_id' => $this->home_team_id,
        'away_team_id' => $this->away_team_id,
        'phase' => $this->phase,
        'match_date_time' => $this->match_date_time,
        'final_home_goals' => $this->final_home_goals,
        'final_away_goals' => $this->final_away_goals,
    ];
}
}
