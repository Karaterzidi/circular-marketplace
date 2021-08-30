<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StarsValue implements Rule
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
        if ($value == 5) {
            return true;
        } elseif ($value == 4) {
            return true;
        } elseif ($value == 3) {
            return true;
        } elseif ($value == 2) {
            return true;
        } elseif ($value == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Review';
    }
}
