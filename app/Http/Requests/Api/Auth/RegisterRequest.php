<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Auth\DealerTypeHelper;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
{
    protected $dealerTypeHelper;

    public function __construct(DealerTypeHelper $dealerTypeHelper)
    {
        $this->dealerTypeHelper = $dealerTypeHelper;
    }
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
            'first_name'     => ['required', 'string'],
            'last_name'      => ['required', 'string'],
            'email'          => ['required', 'string', 'email', Rule::unique('users')],
            'password'       => PasswordRules::register($this->email),
            'business_name'  => ['required', 'string'],
            'license_number' => ['required', 'string'],
            'dealer_bond'    => ['required', 'string'],
            'dealer_type'    => ['required', 'string', Rule::in($this->dealerTypeHelper->validateDealerTypes())],
            'zipcode'        => ['required', 'string'],
            'mobile'         => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => trans('validation.validation_error'),
            'data'    => $validator->errors()
        ], 422));
    }
}
