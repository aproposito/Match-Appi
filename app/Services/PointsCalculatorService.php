<?php

namespace App\Services;

use App\Models\MatchGame;
use App\Models\ChampionPrediction;

class PointsCalculatorService
{
    public function calculate(MatchGame $match): void
    {
        $predictions = $match->matchPredictions()->get();
        
        foreach ($predictions as $prediction) {
            $pointsSign = $this->calculateSign($match, $prediction);
            $pointsHome = $this->calculateHomeGoals($match, $prediction);
            $pointsAway = $this->calculateAwayGoals($match, $prediction);
            
            $prediction->update([
                'points_sign'       => $pointsSign,
                'points_home_goals' => $pointsHome,
                'points_away_goals' => $pointsAway,
                'points_bonus'      => 0,
            ]);
        }

        if ($match->phase === 'final') {
            $winnerId = $match->final_home_goals > $match->final_away_goals
                ? $match->home_team_id
                : $match->away_team_id;
            
            $this->calculateChampion($winnerId);
        }
    }

    public function calculateChampion(int $winnerTeamId): void
    {
        ChampionPrediction::where('team_id', $winnerTeamId)
            ->update(['points_champion' => 150]);

        ChampionPrediction::where('team_id', '!=', $winnerTeamId)
            ->update(['points_champion' => 0]);
    }

    private function calculateSign(MatchGame $match, $prediction): int
    {
        $realSign      = $match->final_home_goals <=> $match->final_away_goals;
        $predictedSign = $prediction->predicted_home_goals <=> $prediction->predicted_away_goals;
        return ($realSign === $predictedSign) ? 50 : 0;
    }

    private function calculateHomeGoals(MatchGame $match, $prediction): int
    {
        if ($prediction->predicted_home_goals != $match->final_home_goals) {
            return 0;
        }
        $bonus = $match->final_home_goals > 2 ? ($match->final_home_goals - 2) * 5 : 0;
        return 20 + $bonus;
    }

    private function calculateAwayGoals(MatchGame $match, $prediction): int
    {
        if ($prediction->predicted_away_goals != $match->final_away_goals) {
            return 0;
        }
        $bonus = $match->final_away_goals > 2 ? ($match->final_away_goals - 2) * 5 : 0;
        return 20 + $bonus;
    }
    
}