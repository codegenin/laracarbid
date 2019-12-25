<?php

namespace App\Http\Requests\Api\Plan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class SubscribeUserRequest.
 */
class SubscribeUserRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plan_id'    => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => __('api.validation.validation_error'),
            'data'    => $validator->errors()
        ], 422));
    }
}
