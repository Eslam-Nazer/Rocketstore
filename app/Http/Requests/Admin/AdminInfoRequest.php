<?php

namespace App\Http\Requests\Admin;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class AdminInfoRequest extends FormRequest
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
        return [
            'name'      => ['required', 'string'],
            'email'     => ['required', Rule::email()->rfcCompliant()->validateMxRecord(), 'unique:users,email'],
            'password'  => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                // TODO: Confirm password
            ],
            'status'    => [
                'required',
                Rule::in(array_column(StatusEnum::cases(), 'value')),
            ]
        ];
    }
}
