<?php

namespace App\Http\Requests\Admin\Brand;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandEditingRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'slug'          => "required|string|max:255|unique:brands,slug,{$id}",
            'status'        => [
                'required',
                Rule::in(array_column(StatusEnum::cases(), 'value'))
            ],
            'meta_title'        => 'string|max:255',
            'meta_description'  => 'string',
            'meta_keywords'     => 'string|max:255'
        ];
    }
}
