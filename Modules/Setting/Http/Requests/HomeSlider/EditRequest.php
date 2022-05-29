<?php

namespace Modules\Setting\Http\Requests\HomeSlider;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\Setting\Entities\HomeSlider;

class EditRequest extends FormRequest
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
        $rules = $this->translationValidationRules(HomeSlider::Class,HomeSlider::getValidationRules(),HomeSlider::translationKey(),$this->id);
        $rules['order'] = $rules['order'].',order,'.$this->id.',id';
        return $rules;
    }

}
