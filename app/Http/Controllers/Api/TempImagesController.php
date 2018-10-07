<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\AttachmentRequestHandler;

class TempImagesController extends Controller
{
    use AttachmentRequestHandler;

    protected function attachmentName()
    {
        return 'image';
    }

    public function store(Request $request)
    {
        return response()->json(['data' => $this->createAttachment($request, config('app.tmp_dir'))]);
    }

    public function destroy(Request $request)
    {
        $this->deleteAttachment($request->image);

        return response()->json(['data' => ['success' => true]]);
    }
}
