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
        'predicted_home_goal' => $this->predicted_home_goal,
        'predicted_away_goal' => $this->predicted_away_goal,
        'points_sign' => $this->points_sign,
        'points_home_goal' => $this->points_home_goal,
        'points_away_goal' => $this->points_away_goal,
        'points_bonus' => $this->points_bonus,
    ];
}
}
