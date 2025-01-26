<?php

namespace App\Http\Requests\Admin\Color;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ColorEditingRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name'      => ["required", "string", "min:3", "max:255", "unique:colors,name,{$id}"],
            'code'      => ["required", "string", "min:7", "max:7", "hex_color"],
            'status'    => [
                'required',
                Rule::enum(StatusEnum::class)
            ]
        ];
    }
}
