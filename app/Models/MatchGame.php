<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchGame extends Model
{
   protected $table = 'matches';
    protected $fillable = [
        'home_team_id', 
        'away_team_id', 
        'phase', 
        'match_date_time', 
        'final_home_goals', 
        'final_away_goals'
    ];

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function matchPredictions(): HasMany
    {
        return $this->hasMany(MatchPrediction::class);
    }
}
