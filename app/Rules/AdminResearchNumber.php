<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\SurveyInfo;

class AdminResearchNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value == 545789;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '有効な暗証番号ではありません。';
    }
}
