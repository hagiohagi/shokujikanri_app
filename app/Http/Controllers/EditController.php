<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealRecord;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class EditController extends Controller
{
    public function index(Request $request)
    {
        return view('/edit');
    }

    public function update(Request $request)
    {

        $rules = [
            'meal_type' => ['required'],
            'eat_place' => ['required'],
            'eat_date' => ['required'],
            'eat_time' => ['required'],
            'memo' => ['string', 'max:500']
        ];

        $this->validate($request, $rules);

        return MealRecord::query()->update([
            'meal_type' => $request['meal_type'],
            'eat_place' => $request['eat_place'],
            'eat_date' => $request['eat_date'],
            'eat_time' => $request['eat_time'],
            'memo' => $request['memo'],
            'update_user_id' => FacadesAuth::user()->user_id
        ]);

        return view('/index');
    }
}
