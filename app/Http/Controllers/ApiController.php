<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('public');
        $fileName = basename($path);
        $url = sprintf("http://127.0.0.1:8000/storage/%s", $fileName);

        $upload = new Upload;
        $upload->file_name = $fileName;
        $upload->path = $path;
        $upload->url = $url;
        $upload->save();

        return response()->json([
            'data' => [
                'fileName' => $fileName,
                'URL' => $url
            ],
        ]);
    }

    public function fetchUploadedPicture()
    {
        return Upload::all();
    }

    public function delete(Upload $upload)
    {
        if (Storage::exists($upload->path)) {
            Storage::delete($upload->path);
            $upload->delete();
            return response('', 204);
        }

        return response('', 404);
    }
}
