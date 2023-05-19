<?php

namespace App\Http\Requests\Auth;

use App\Services\Concerns\ValidationError;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    use ValidationError;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }
}
