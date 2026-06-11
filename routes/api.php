<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChampionPredictionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\MatchGameController;
use App\Http\Controllers\Api\MatchPredictionController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/matches', [MatchGameController::class, 'index']);
    Route::post('/matches', [MatchGameController::class, 'store']);
    Route::get('/match-predictions', [MatchPredictionController::class, 'index']);
    Route::post('/match-predictions', [MatchPredictionController::class, 'store']);
    Route::put('/match-predictions/{matchPrediction}', [MatchPredictionController::class, 'update']);
    Route::delete('/match-predictions/{matchPrediction}', [MatchPredictionController::class, 'destroy']);
    Route::get('/champion-predictions', [ChampionPredictionController::class, 'index']);
    Route::post('/champion-predictions', [ChampionPredictionController::class, 'store']);
    Route::put('/champion-predictions/{championPrediction}', [ChampionPredictionController::class, 'update']);


    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/teams', [TeamController::class, 'store']);
        Route::put('/teams/{team}', [TeamController::class, 'update']);
        Route::delete('/teams/{team}', [TeamController::class, 'destroy']);
        Route::put('/matches/{matchGame}', [MatchGameController::class, 'update']);
        Route::delete('/matches/{matchGame}', [MatchGameController::class, 'destroy']);
      

    });
});
