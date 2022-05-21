<?php

namespace Modules\Acl\Http\Requests\User\Api;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Basic\Traits\ApiResponseTrait;
use Modules\Basic\Traits\validationRulesTrait;

class UpdateRequest extends FormRequest
{
    use ApiResponseTrait, validationRulesTrait;

    /**
     * Determine if the User is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (isset($this->mobile)) {
            $this->merge(['mobile' => $this->convertPersian($this->mobile)]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::getValidationRulesUpdate();
        $rules['fullname'] = str_replace("required|", "", $rules['fullname']);
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }


}
