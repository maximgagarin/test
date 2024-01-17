<?php

namespace App\Rules;

use App\Models\Counter;
use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    protected $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
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
            $lastValue = Counter::where('areas_id', $this->id)->latest('id')->value('value');
        return $value > $lastValue;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Должно быть больше последнего значения';
    }
}
