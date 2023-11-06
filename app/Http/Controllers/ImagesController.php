<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{

    public function index()
    {
        return Image::all();
    }

    public function delete(Image $image)
    {
        if (Storage::exists($image->path)) {
            Storage::delete($image->path);
            $image->delete();
            return response('', 204);
        }

        return response('', 404);
    }

    public function create(Request $request)
    {
        $path = $request->file('file')->store('public');
        $fileName = basename($path);
        $url = sprintf("http://127.0.0.1:8000/storage/%s", $fileName);

        $image = new Image;
        $image->file_name = $fileName;
        $image->path = $path;
        $image->url = $url;
        $image->save();

        return response()->json([
            'data' => [
                'fileName' => $fileName,
                'URL' => $url
            ],
        ]);
    }
}
