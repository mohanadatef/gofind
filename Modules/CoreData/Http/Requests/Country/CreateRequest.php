<?php

namespace Modules\CoreData\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Entities\Country;

class CreateRequest extends FormRequest
{
    use validationRulesTrait;
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
        return $this->translationValidationRules(Country::Class,Country::getValidationRules(),Country::translationKey());
    }


}
