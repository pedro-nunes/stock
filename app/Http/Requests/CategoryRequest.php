<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CategoryRequest extends BaseFormRequest
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
                    'name' => [
                        'required',
                        'string',
                        'min:3',
                        'max:25',
                        Rule::unique('categories')->ignore($this->id)
                    ],
                    'slug' => [
                        'string',
                        'min:3',
                        'max:30',
                        Rule::unique('categories')->ignore($this->id)
                    ],
                ];
                break;
            case 'POST':
                $rules = [
                    'name' => ['required', 'string', 'min:3', 'max:25', 'unique:categories'],
                    'slug' => ['string', 'min:3', 'max:30', 'unique:categories'],
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
}
