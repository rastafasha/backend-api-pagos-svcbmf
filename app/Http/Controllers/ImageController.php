<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Helpers\Uploader;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function file(Request $request){
        $image = new Image;

        if ($request->hasFile('image')) {
            $competeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($competeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ', '_', $fileNameOnly) . '-' . rand() . '_'.time(). '.' . $extension;
            $path = $request->file('image')->storeAs('public/image', $compPic);
            $image->image = $compPic;
        }

        if ($image->save()) {
            return response()->json([
                // 'code' => 200,
                // 'status' => 'image upload',
                'image' => $image
            ], 200);
        }else {
            return response()->json([
                'code' => 500,
                'status' => 'image NO upload',
            ], 200);
        }
    }

    public function fileClassUploader(Request $request){

        $image = new Image;

        if ($request->hasFile('image')) {
            $file = Uploader::uploadFile('image',  '/img/image');
        }


        if ($image->save()) {
            return response()->json([
                'code' => 200,
                'status' => 'image upload',
                'image' => $image
            ], 200);
        }else {
            return response()->json([
                'code' => 500,
                'status' => 'image NO upload',
            ], 200);
        }

    }
}
