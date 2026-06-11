<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChampionPredictionResource extends JsonResource
{
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'user_id' => $this->user_id,
        'team_id' => $this->team_id,
        'points_champion' => $this->points_champion,
    ];
}
}
