<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class VendorRequest extends BaseFormRequest
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
                    'name' => [
                        'required',
                        'string',
                        'min:3',
                        Rule::unique('vendors')->ignore($this->id)
                    ],
                    'company_name' => [
                        'required',
                        'string',
                        'min:3',
                        Rule::unique('vendors')->ignore($this->id)
                    ],
                    'document' => [
                        'required',
                        'string',
                        'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/'
                    ],
                    'reg_state' => [
                        'nullable',
                        'string',
                        'min:9',
                        'max:14',
                        'alpha_num:ascii'
                    ],
                    'reg_municipal' => [
                        'nullable',
                        'string',
                        'min:7',
                        'max:15',
                        'alpha_num:ascii'
                    ],
                    'responsible' => [
                        'required',
                        'string',
                        'min:3',
                        'max:20'
                    ],
                    'phone' => [
                        'required',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/'
                    ],
                    'email' => [
                        'required',
                        'max:50',
                        'email:rfc,dns',
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
                    'observer' => [
                        'nullable',
                        'string'
                    ],
                ];
                break;
            case 'POST':
                $rules = [
                    'name' => [
                        'required',
                        'string',
                        'min:3',
                        'unique:vendors'
                    ],
                    'company_name' => [
                        'required',
                        'string',
                        'min:3',
                        'unique:vendors'
                    ],
                    'document' => [
                        'required',
                        'string',
                        'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/'
                    ],
                    'reg_state' => [
                        'nullable',
                        'string',
                        'min:9',
                        'max:14',
                        'alpha_num:ascii'
                    ],
                    'reg_municipal' => [
                        'nullable',
                        'string',
                        'min:7',
                        'max:15',
                        'alpha_num:ascii'
                    ],
                    'responsible' => [
                        'required',
                        'string',
                        'min:3',
                        'max:20'
                    ],
                    'phone' => [
                        'required',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/'
                    ],
                    'email' => [
                        'required',
                        'max:50',
                        'email:rfc,dns',
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
                    'observer' => [
                        'nullable',
                        'string'
                    ],
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
}
