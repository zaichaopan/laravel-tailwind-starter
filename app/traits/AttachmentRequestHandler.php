<?php

namespace App\Traits;

use Facades\App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait AttachmentRequestHandler
{
    protected function attachmentName()
    {
        return 'attachment';
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [$this->attachmentName() => 'required|mimes:jpg,jpeg,png|max:8000']
        );
    }

    protected function createAttachment(Request $request, $storeDir)
    {
        $attachmentName = $this->attachmentName();
        $this->validator($request->all())->validate();
        $attachment = Attachment::createFromUploadedFile($request->{$attachmentName}, $storeDir);
        return $attachment;
    }

    protected function deleteAttachment($path, Attachment $attachment = null)
    {
        abort_unless($path = $path, 404);
        $attachment = $attachment ?? Attachment::wherePath($path)->first();
        optional($attachment)->delete();
    }
}
