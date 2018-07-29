<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NullOrGreaterThanMinLength implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $min;
    

    public function __construct($min)
    {
        $this->min = $min;
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
        $length = strlen($value);
        return $value == null || $this->greaterThan($length);
    }

    private function greaterThan($value)
    {
        return $value >= $this->min;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be empty or atleast '. $this->min.' characters long.';
        // :atttribute is replace with field name that failed passes method
    }
}
