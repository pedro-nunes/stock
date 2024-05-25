<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse|void
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $msg) {
                $json['trigger'][] = alert($msg, false, false, 'warning');
            }
            throw new HttpResponseException(response()->json($json, 200));
        }
        parent::failedValidation($validator);
    }
}
