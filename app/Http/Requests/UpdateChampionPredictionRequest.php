<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChampionPredictionRequest extends FormRequest
{
  public function authorize(): bool
{
    $prediction = $this->route('championPrediction');
    return $this->user()->role !== 'admin' && $this->user()->id === $prediction->user_id;
}

public function rules(): array
{
    return [
        'team_id' => 'sometimes|exists:teams,id',
    ];
}

public function withValidator($validator): void
{
    $validator->after(function ($validator) {
        $groupStageActive = \App\Models\MatchGame::where('phase', 'groups')
            ->where('match_date_time', '>', now())
            ->exists();

        if (!$groupStageActive) {
            $validator->errors()->add('team_id', 'La fase de grupos ha terminado. No puedes editar tu predicción de campeón.');
        }
    });
}
}
