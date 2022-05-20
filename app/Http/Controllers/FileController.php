<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function get_request_image(Request $request, $meal_photo)
    {
        if(!is_null($meal_photo)) {
        $rp = storage_path('/public/images'.$meal_photo);
        if(File::exists($rp)){
            return response()->file($rp);
        }
        }
    }
}
