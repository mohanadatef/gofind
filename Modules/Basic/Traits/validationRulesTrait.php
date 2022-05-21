<?php

namespace Modules\Basic\Traits;

use Illuminate\Validation\Rule;
use function language;
use function languageLocale;

trait validationRulesTrait
{
    public function translationValidationRules($class, $rules, $keys, $id = null)
    {
        foreach (language() as $lang) {
            foreach ($keys as $key) {
                $rule = Rule::unique('translations', 'value')
                    ->where('category_type', $class)
                    ->where('key', $key)
                    ->where('language_id', $lang->id);
                if ($id) {
                    $rule = $rule->ignore($id, 'category_id');
                }
                $rules[$key . '.' . $lang->code] = $rule;
                $rules[$key . '.' . $lang->code] .= "|string";
                $rules[$key . '.' . languageLocale()] .= '|required';
            }
        }
        return $rules;
    }

    public function convertPersian($string)
    {
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));

    }
}
