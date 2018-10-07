<?php

namespace App\Http\Requests\Places;

use App\{Attachment, Place};
use App\Rules\{Latitude, Longitude};
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'address' => 'required|max:255',
            'lat' => ['nullable', new Latitude],
            'lng' => ['nullable', new Longitude],
            'description' => 'required|string',
            'images' => 'nullable|array|min:1'
        ];
    }

    /**
     * Persist store place request.
     *
     * @return \App\Place
     */
    public function persist()
    {
        $place = $this->user()->places()->create(array_except($this->validated(), ['images']));
        $attachments = Attachment::whereIn('path', array_unique($this->images ?? []))->get();

        if ($attachments->count()) {
            $place->images()->saveMany($attachments);
        }

        return $place->fresh();
    }
}
