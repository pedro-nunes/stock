<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        switch (mb_strtoupper($this->method())) {
            case 'PUT':
                $rules = [
                    'code' => [
                        'required',
                        'numeric',
                        'max_digits:18',
                        Rule::unique('products')->ignore($this->id),
                    ],
                    'name' => [
                        'required',
                        'string',
                        'min:3',
                        'max:50',
                        Rule::unique('products')->ignore($this->id),
                    ],
                    'category_id' => [
                        'required',
                        'numeric',
                        'max:9',
                    ],
                    'manufacturer_id' => [
                        'nullable',
                        'numeric',
                        'max:9',
                    ],
                    'vendor_id' => [
                        'nullable',
                        'numeric',
                        'max:9',
                    ],
                    'sale_price' => [
                        'required',
                    ],
                    'cost_price' => [
                        'required'
                    ],
                    'min_stock' => [
                        'required',
                        'numeric',
                    ],
                    'variation' => [
                        'nullable',
                        'string',
                    ],
                    'status' => [
                        'nullable',
                        'numeric',
                        'size:1'
                    ],
                    'thumbnail' => [
                        'nullable',
                        'image',
                        'mimes:jpeg,png,jpg,gif,svg,webp',
                        'max:2048'
                    ],
                ];
                break;
                case 'POST':
                    $rules = [
                        'code' => [
                            'required',
                            'numeric',
                            'max_digits:18',
                            'unique:products,code',
                        ],
                        'name' => [
                            'required',
                            'min:3',
                            'max:50',
                            'unique:products,name',
                        ],
                        'category_id' => [
                            'required',
                            'numeric',
                            'max:9',
                        ],
                        'manufacturer_id' => [
                            'nullable',
                            'numeric',
                            'max:9',
                        ],
                        'vendor_id' => [
                            'nullable',
                            'numeric',
                            'max:9',
                        ],
                        'sale_price' => [
                            'required',
                        ],
                        'cost_price' => [
                            'required'
                        ],
                        'min_stock' => [
                            'required',
                            'numeric',
                        ],
                        'variation' => [
                            'nullable',
                            'string',
                        ],
                        'thumbnail' => [
                            'nullable',
                            'image',
                            'mimes:jpeg,png,jpg,gif,svg,webp',
                            'max:2048'
                        ]
                    ];
                break;
            default:
                break;
        }
        return $rules;
    }
}
