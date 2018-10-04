<?php

namespace App\Traits;

use App\Attachment;
use Illuminate\Http\Request;

trait UploadTempAttachment
{
    protected function attachmentName()
    {
        return 'attachment';
    }

    protected function tempDir()
    {
        return 'temp';
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $file = $request->file($this->attachmentName());
        $extension = $file->extension();
        $size = $file->getClientSize();
        $path = $file->store($this->tempDir());

        $attachment = Attachment::create(compact('path', 'size', 'extension'));

        return response()->json(['data' => $attachment]);
    }

    public function destroy(Request $request)
    {
        if (!$path = $request->path) {
            return response()->json(['data' => null], 404);
        }

        $attachment = Attachment::wherePath($path)->first();

        optional($attachment)->remove();

        return response()->json(['data' => null], 200);
    }
}
