<?php

namespace App\Http\Requests\Places;

class Update extends Store
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_except(parent::rules(), ['image', 'images.*']);
    }

    /**
     * Persist update place request.
     *
     * @return \App\Place
     */
    public function persist()
    {
        return tap($this->place)->update($this->validated());
    }
}
