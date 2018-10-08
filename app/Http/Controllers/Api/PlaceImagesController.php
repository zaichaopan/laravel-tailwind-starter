<?php

namespace App\Http\Controllers\Api;

use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AttachmentRequestHandler;

class PlaceImagesController extends Controller
{
    use AttachmentRequestHandler;

    public function __construct()
    {
        $this->middleware('owner:place');
    }

    public function store(Place $place, Request $request)
    {
        $attachment = $this->createAttachment($request, $place->imageRootDir());
        $place->images()->save($attachment);
        return response()->json(['data' => ['url' => $attachment->url]]);
    }

    public function destroy(Place $place, Request $request)
    {
        $this->deleteAttachment($request->path);
        return response()->json(['data' => ['success' => true]]);
    }

    protected function attachmentName()
    {
        return 'image';
    }
}
