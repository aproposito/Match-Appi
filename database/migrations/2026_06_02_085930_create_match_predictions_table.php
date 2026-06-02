<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('match_predictions', function (Blueprint $table) {
            $table->id();
            $table->integer('predicted_home_goals')->nullable();
            $table->integer('predicted_away_goals')->nullable();
            $table->integer('points_sign')->nullable();
            $table->integer('points_home_goals')->nullable();
            $table->integer('points_away_goals')->nullable();
            $table->integer('points_bonus')->nullable();
            $table->foreignId('match_id')->constrained('matches');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_predictions');
    }
};
