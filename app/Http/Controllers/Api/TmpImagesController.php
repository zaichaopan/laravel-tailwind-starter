<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AttachmentRequestHandler;

class TmpImagesController extends Controller
{
    use AttachmentRequestHandler;

    public function store(Request $request)
    {
        return response()->json(['data' => $this->createAttachment($request, config('app.tmp_dir'))]);
    }

    public function destroy(Request $request)
    {
        $this->deleteAttachment($request->path);

        return response()->json(['data' => ['success' => true]]);
    }

    protected function attachmentName()
    {
        return 'image';
    }
}
