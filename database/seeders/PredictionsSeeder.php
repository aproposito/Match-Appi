<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MatchPrediction;
use App\Models\MatchGame;
use App\Models\ChampionPrediction;
use App\Models\Team;
use App\Services\PointsCalculatorService;

class PredictionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Los admin no apuestan (regla de negocio de la app)
        $users = User::where('role', 'user')->get();

        // El único partido con resultado ya puesto es el "demo" de ayer
        $resolvedMatch = MatchGame::whereNotNull('final_home_goals')->first();

        foreach ($users as $user) {
            MatchPrediction::factory()->create([
                'match_id' => $resolvedMatch->id,
                'user_id' => $user->id,
            ]);

            ChampionPrediction::factory()->create([
                'team_id' => Team::inRandomOrder()->first()->id,
                'user_id' => $user->id,
            ]);
        }

        // Recalcula los puntos de las apuestas de ese partido
        // (sin esto, points_sign/points_home_goals/points_away_goals se
        // quedarían a null: el evento MatchResultRecorded solo se dispara
        // al actualizar un partido vía API, no al sembrar datos)
        (new PointsCalculatorService())->calculate($resolvedMatch);
    }
}
