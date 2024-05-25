<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ManufacturerRequest extends BaseFormRequest
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
                        Rule::unique('manufacturers')->ignore($this->id)
                    ],
                    'slug' => [
                        'string',
                        'min:3',
                        'max:30',
                        Rule::unique('manufacturers')->ignore($this->id)
                    ],
                    // Imagem
                ];
                break;
            case 'POST':
                $rules = [
                    'name' => ['required', 'string', 'min:3', 'max:25', 'unique:manufacturers'],
                    'slug' => ['string', 'min:3', 'max:30', 'unique:manufacturers'],
                    // Imagem
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
}
