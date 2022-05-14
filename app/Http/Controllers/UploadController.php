<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealRecord;
use App\Models\MealPhoto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UploadController extends Controller
{
    public function index(Request $request)
    {
        return view('/upload');
    }

    public function create(Request $request)
    {

        $rules = [
            'files.*.photo' => ['required','image|mimes:jpg,jpeg,bmp,png'],
            'meal_type' => ['required'],
            'eat_place' => ['required'],
            'eat_date' => ['required'],
            'eat_time' => ['required'],
            'memo' => ['max:500']
        ];

        $this->validate($request, $rules);

        $meal = new MealRecord();
        $photo = new MealPhoto();

        $meal->create([
            'user_id' => Auth::user()->id,
            'meal_type' => $request['meal_type'],
            'eat_place' => $request['eat_place'],
            'eat_date' => $request['eat_date'],
            'eat_time' => $request['eat_time'],
            'memo' => $request['memo'],
            'create_user_id' => Auth::user()->id,
        ]);

        if ($request->has('files')) {
            foreach($request->file('files') as $file){
                
                $file_name = $file['photo']->getClientOriginalName();
                $file['photo']->storeAS('',$file_name); //画像をストレージに保存
                $photo->photo_path = $file_name;
                $meal->mealPhotos()->save($photo);
            }
        }

        return view('/index');
    }
}
