<?php

namespace Modules\Acl\Http\Requests\ForgetPassword\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Acl\Entities\ForgetPassword;
use Modules\Basic\Traits\ApiResponseTrait;

class changePasswordRequest extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Determine if the User is authorized to make this request.
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
        return ForgetPassword::getValidationRules();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }

}
