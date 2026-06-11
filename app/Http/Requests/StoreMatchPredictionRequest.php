<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchPredictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role !== 'admin';
    }

    public function rules(): array
    {
        return [
            'match_id' => [
                'required',
                'exists:matches,id',
                function ($attribute, $value, $fail) {
                    $match = \App\Models\MatchGame::find($value);
                    if ($match && $match->match_date_time <= now()) {
                        $fail('No puedes apostar a un partido que ya ha empezado.');
                    }
                },
            ],
            'predicted_home_goals' => 'required|integer|min:0',
            'predicted_away_goals' => 'required|integer|min:0',
        ];
    }
}