<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMatchRequest extends FormRequest
{
public function authorize(): bool
{
    return $this->user()->role === 'admin';
}

public function rules(): array
{
    return [
        'home_team_id' => 'required|exists:teams,id',
        'away_team_id' => 'required|exists:teams,id',
        'phase' => 'required|in:groups,round_of_16,quarters,semis,final',
        'match_date_time' => 'required|date',
        'final_home_goals' => 'nullable|integer|min:0',
        'final_away_goals' => 'nullable|integer|min:0',
    ];
}
}