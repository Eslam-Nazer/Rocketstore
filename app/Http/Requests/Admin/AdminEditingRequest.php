<?php

namespace App\Http\Requests\Admin;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class AdminEditingRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('id');
        return [
            'name'          => ['required', 'string', 'min:3', 'max:255'],
            'email'         => ["required", Rule::email()->rfcCompliant(false)->validateMxRecord(), "unique:users,email,{$userId}"],
            'password'      => [
                'nullable',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'status'        => [
                'required',
                Rule::enum(StatusEnum::class),
            ],
        ];
    }
}
