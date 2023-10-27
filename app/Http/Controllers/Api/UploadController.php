<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->has('image')) {
            $image = $request->image;
            $nameFile = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('upload/image');
            $image->move($path, $nameFile);

            return response()->json([
                'image_path' => '/upload/image/' . $nameFile,
                'base_url' => url('/'),
            ]);
        }
    }

    public function uploadMultipleImages(Request $request)
    {
        if ($request->has('image')) {
            $image = $request->image;
            foreach ($image as $key => $image) {
                $nameFile = time() . $key . '.' . $image->getClientOriginalExtension();
                $path = public_path('upload/image');
                $image->move($path, $nameFile);
            }
            return response()->json([
                'status' => 'upload successfully',
            ]);
        }
    }
}
