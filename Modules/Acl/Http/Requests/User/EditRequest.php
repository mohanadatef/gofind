<?php

namespace Modules\Acl\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;

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

    protected function prepareForValidation()
    {
        $this->merge(['mobile'=>$this->convertPersian($this->mobile)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= User::getValidationRulesUpdate();
        $rules['mobile'] = $rules['mobile'].',mobile,'.$this->id.',id';
        $rules['order'] = $rules['order'].',order,'.$this->id.',id';
        $rules['email'] = $rules['email'].',email,'.$this->id.',id';
        return $rules;
    }

}
