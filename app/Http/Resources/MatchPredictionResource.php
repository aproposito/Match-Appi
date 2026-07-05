<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchPredictionResource extends JsonResource
{
   public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'match_id' => $this->match_id,
        'user_id' => $this->user_id,
        'predicted_home_goals' => $this->predicted_home_goals,
        'predicted_away_goals' => $this->predicted_away_goals,
        'points_sign' => $this->points_sign,
        'points_home_goals' => $this->points_home_goals,
        'points_away_goals' => $this->points_away_goals,
        'points_bonus' => $this->points_bonus,
    ];
}
}
