<?php

namespace Modules\Property\Http\Requests\Property\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Basic\Traits\ApiResponseTrait;
use Modules\Property\Entities\Property;

class CreateRequest extends FormRequest
{
    use ApiResponseTrait;

    private $taskService;
    /**
     * Determine if the Task is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * [__construct instantiate object]
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => user()->id]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules()
    {
        return Property::getValidationRules();
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }

}
