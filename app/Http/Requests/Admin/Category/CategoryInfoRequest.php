<?php

namespace App\Http\Requests\Admin\Category;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryInfoRequest extends FormRequest
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
            'name'              => 'required|string|unique:categories,name|max:255',
            'status'            => [
                'required',
                Rule::in(array_column(StatusEnum::cases(), 'value'))
            ],
            'meta_title'        => 'max:255',
            'meta_description'  => '',
            'meta_keywords'     => 'max:255'
        ];
    }
}
