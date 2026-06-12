<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRankingResource extends JsonResource
{
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'match_points' => $this->match_points ?? 0,
        'champion_points' => $this->champion_points ?? 0,
        'total_points' => ($this->match_points ?? 0) + ($this->champion_points ?? 0),
    ];
}
}
