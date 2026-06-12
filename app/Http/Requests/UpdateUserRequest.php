<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'name' => 'sometimes|string',
        'email' => 'sometimes|email|unique:users,email,' . $this->route('user')->id,
        'password' => 'sometimes|min:8|confirmed',
    ];
}
}
