<?php

namespace App\Http\Requests\User;

use App\Services\Concerns\ValidationError;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'string', 'email:rfc', 'max:255', Rule::unique('users')->ignore(request()->user()->id)],
            'phone_number' => ['required', Rule::unique('users')->ignore(request()->user()->id)],
        ];
    }
}
