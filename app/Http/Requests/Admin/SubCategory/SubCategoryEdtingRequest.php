<?php

namespace App\Http\Requests\Admin\SubCategory;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryEdtingRequest extends FormRequest
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
            'name'              => "required|string|max:255|unique:sub_categories,name,{$id}",
            'slug'              => "required|string|max:255|unique:sub_categories,slug,{$id}",
            'status'            => [
                'required',
                Rule::in(array_column(StatusEnum::cases(), 'value'))
            ],
            'meta_title'        => 'string|max:255',
            'meta_description'  => 'string|max:255',
            'meta_keywords'     => 'string|max:255',
            'category'          => 'required|integer',
        ];
    }
}
