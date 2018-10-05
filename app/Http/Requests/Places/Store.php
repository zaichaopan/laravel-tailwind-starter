<?php

namespace App\Http\Requests\Places;

use App\Place;
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
            'lat' => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string'
        ];
    }

    /**
     * Persist store place request.
     *
     * @return \App\Place
     */
    public function persist()
    {
        $place = Place::create($array_except($this->validated(), ['images']));

        $images = array_unique($request->images);

        $attachments = Attachment::whereIn('path', $images)->get();

        if ($attachments->count()) {
            $place->images->saveMany($attachments);
        }

        return $place;
    }
}
