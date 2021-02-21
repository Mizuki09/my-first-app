<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class appRule implements Rule
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
        $matchUrl = "https://www.youtube.com/watch?v=";
//        dd($matchUrl);
        return strpos($matchUrl, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '正しいurlを入力してください';
    }
}
