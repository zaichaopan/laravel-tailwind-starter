<?php

namespace App\Http\Controllers;

use App\Traits\UploadTempAttachment;
use Illuminate\Support\Facades\Validator;

class TempImagesController extends Controller
{
    use UploadTempAttachment;

    /**
     * Get a validator for an incoming upload temporary image request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            ['image' => 'required|mimes:jpg,jpeg,png|max:8000']
         );
    }

    protected function attachmentName()
    {
        return 'image';
    }
}
