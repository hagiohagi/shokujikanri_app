<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function getRequestImage(Request $request, $meal_photo)
    {
        if(!is_null($meal_photo)) {
        $rp = storage_path('/app/images/'.$meal_photo);
        if(File::exists($rp)){
            return response()->file($rp);
        }
        }
    }

    public function getRequestPdf()
    {
        return response()->file(storage_path('app/pdf/shokujikanri_manual.pdf'));
    }

    
}
