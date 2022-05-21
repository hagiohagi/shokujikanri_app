<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MealRecord;
use App\Models\MealPhoto;
use App\Models\MealDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class UploadController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.upload', ['user' => $user]);
    }

    public function create(Request $request, $id)
    {

        $rules = [
            'meal_type' => ['required'],
            'eat_place' => ['required'],
            'eat_date' => ['required'],
            'eat_time' => ['required'],
            'memo' => ['max:500'],

            'food' => ['required'],
            'ingredient' => ['required'],
            'amount' => ['required'],

            'files.*.photo' => ['required','image|mimes:jpg,jpeg,bmp,png'],
        ];

        $this->validate($request, $rules);

        $meal = MealRecord::create([
            'user_id' => Auth::user()->id,
            'meal_type' => $request['meal_type'],
            'eat_place' => $request['eat_place'],
            'eat_date' => $request['eat_date'],
            'eat_time' => $request['eat_time'],
            'memo' => $request['memo'],
            'create_user_id' => Auth::user()->id,
        ]);

        $meal_id = $meal->meal_id;

        MealDetail::create([
            'meal_id' => $meal_id,
            'food' => $request['food'],
            'ingredient' => $request['ingredient'],
            'amount' => $request['amount'],
            'order_num' => 1,
            'create_user_id' => Auth::user()->id,
        ]);



        if ($request->has('files')) {
            foreach($request->file('files') as $file){
                
                $file_name = $file['photo']->getClientOriginalName();
                $file['photo']->storeAS('images',$file_name); //画像をストレージに保存
                
                MealPhoto::create([
                    'meal_id' => $meal_id,
                    'photo_path' => $file_name,
                    'order_num' => 1,
                    'create_user_id' => Auth::user()->id,
                ]);
            }
        }

        return redirect()->route('admin.index', ['id' => $id]);
    }
}
