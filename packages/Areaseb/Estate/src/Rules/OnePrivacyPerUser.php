<?php

namespace Areaseb\Estate\Rules;

use Areaseb\Estate\Models\Client;
use Illuminate\Contracts\Validation\Rule;

class OnePrivacyPerUser implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Client::withoutPrivacy()
            ->where('id', $value)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This user already has a privacy generated';
    }
}
