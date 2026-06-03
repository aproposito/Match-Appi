<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MatchGame;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchPrediction extends Model
{   use HasFactory;

    protected $fillable = [
        'predicted_home_goals',
        'predicted_away_goals',
        'points_sign',
        'points_home_goals',
        'points_away_goals',
        'points_bonus',
    ];

    public function matchGame(): BelongsTo
    {
        return $this->belongsTo(MatchGame::class, 'match_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
