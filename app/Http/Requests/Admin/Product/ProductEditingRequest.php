<?php

namespace App\Http\Requests\Admin\Product;

use App\Enum\StatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductEditingRequest extends FormRequest
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
            'title'                     => ['required', 'string', 'min:3', 'max:255', "unique:products,title,{$id}"],
            'sku'                       => ['string'],
            'price'                     => ['numeric', 'min:0', 'not_in:0'],
            'old_price'                 => ['numeric', 'min:0'],
            'short_description'         => ['string'],
            'description'               => ['string'],
            'additional_information'    => ['string'],
            'shipping_returns'          => ['string'],
            'status'                    => [
                'required',
                Rule::enum(StatusEnum::class)
            ],
            'brand'                     => ['integer'],
            'sub_category'              => ['integer'],
            'category'                  => ['integer'],
            'color'                     => ['array'],
            'size'                      => ['array'],
            'images'                    => ['array'],
            'images.*'                  => ["image", "mimes:png,jpg,jpeg", "max:20480"]
        ];
    }
}
