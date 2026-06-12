<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchPredictionRequest extends FormRequest
{
public function authorize(): bool
{
    $prediction = $this->route('matchPrediction');
    return $this->user()->role !== 'admin' && $this->user()->id === $prediction->user_id;
}

public function rules(): array
{
    return [
        'predicted_home_goals' => 'sometimes|integer|min:0',
        'predicted_away_goals' => 'sometimes|integer|min:0',
    ];
}
public function withValidator($validator): void
{
    $validator->after(function ($validator) {
        $prediction = $this->route('matchPrediction');
        if ($prediction && $prediction->matchGame->match_date_time <= now()) {
            $validator->errors()->add('match_id', 'No puedes editar una predicción de un partido que ya ha empezado.');
        }
    });
}
}
