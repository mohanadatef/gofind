<?php

namespace Modules\CoreData\Http\Requests\State;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Entities\State;

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
        $rules= State::getValidationRules();
        $rules = $this->translationValidationRules(State::Class,$rules,State::translationKey(),$this->id);
        $rules['order'] = $rules['order'].',order,'.$this->id.',id';
        return $rules;
    }

}
