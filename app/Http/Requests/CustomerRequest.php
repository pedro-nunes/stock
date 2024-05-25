<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CustomerRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //dd($this->all());
        $rules = [];
        switch (mb_strtoupper($this->method())) {
            case 'PUT':
                $rules = [
                    'first_name' => [
                        'required',
                        'string',
                        'min:3',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'last_name' => [
                        'required',
                        'string',
                        'min:3',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'document' => [
                        'required',
                        'string',
                        'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)/',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'register' => [
                        'nullable',
                        'string',
                        'min:7',
                        'max:14',
                        'alpha_num:ascii',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'whatsapp' => [
                        'nullable',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'phone' => [
                        'nullable',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'email' => [
                        'required',
                        'max:50',
                        'email:rfc,dns',
                        Rule::unique('customers')->ignore($this->id)
                    ],
                    'where_find' => [
                        'nullable',
                        'string'
                    ],
                    'zip' => [
                        'required',
                        'regex:/^\d{2}\.?\d{3}-\d{3}$/'
                    ],
                    'address' => [
                        'required',
                        'string',
                        'max:50',
                    ],
                    'number' => [
                        'required',
                        'string',
                        'max:8',
                    ],
                    'complement' => [
                        'nullable',
                        'string',
                        'max:30'
                    ],
                    'district' => [
                        'required',
                        'string',
                        'max:35'
                    ],
                    'city' => [
                        'required',
                        'string',
                        'max:30'
                    ],
                    'state' => [
                        'required',
                        'string',
                        'size:2'
                    ],
                ];
                break;
            case 'POST':
                $rules = [
                    'first_name' => [
                        'required',
                        'string',
                        'min:3',
                        'unique:customers'
                    ],
                    'last_name' => [
                        'required',
                        'string',
                        'min:3',
                        'unique:customers'
                    ],
                    'document' => [
                        'required',
                        'string',
                        'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)/',
                        'unique:customers'
                    ],
                    'register' => [
                        'nullable',
                        'string',
                        'min:7',
                        'max:14',
                        'alpha_num:ascii',
                        'unique:customers'
                    ],
                    'whatsapp' => [
                        'required',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                        'unique:customers'
                    ],
                    'phone' => [
                        'nullable',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                        'unique:customers'
                    ],
                    'email' => [
                        'required',
                        'max:50',
                        'email:rfc,dns',
                        'unique:customers'
                    ],
                    'where_find' => [
                        'nullable',
                        'string'
                    ],
                    'zip' => [
                        'required',
                        'regex:/^\d{2}\.?\d{3}-\d{3}$/'
                    ],
                    'address' => [
                        'required',
                        'string',
                        'max:50',
                    ],
                    'number' => [
                        'required',
                        'string',
                        'max:8',
                    ],
                    'complement' => [
                        'nullable',
                        'string',
                        'max:30'
                    ],
                    'district' => [
                        'required',
                        'string',
                        'max:35'
                    ],
                    'city' => [
                        'required',
                        'string',
                        'max:30'
                    ],
                    'state' => [
                        'required',
                        'string',
                        'size:2'
                    ],
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
}
