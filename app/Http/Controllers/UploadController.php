<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealRecord;
use Illuminate\Support\Facades\Auth as FacadesAuth;


class UploadController extends Controller
{
    public function index(Request $request)
    {
        return view('/upload');
    }

    public function create(Request $request)
    {

        $rules = [
            'meal_type' => ['required'],
            'eat_place' => ['required'],
            'eat_date' => ['required'],
            'eat_time' => ['required'],
            'memo' => ['max:500']
        ];

        $this->validate($request, $rules);

        return MealRecord::create([
            
            'meal_type' => $request['meal_type'],
            'eat_date' => $request['eat_date'],
            'eat_time' => $request['eat_time'],
            'memo' => $request['memo'],
            'create_user_id' => FacadesAuth::user()->id
        ]);

        return view('/index');
    }
}
